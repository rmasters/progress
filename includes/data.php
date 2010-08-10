<?php

/**
 * Data sourcing - this is a little bit of commentary on the SQL as I found it
 * interesting.
 * 
 * We want to get each goal, and it's latest update (but not if no update exists).
 *
 * The method of doing this is fairly complex (I need to learn about it) - the
 * "per-group-maximum" question. Source:
 * http://stackoverflow.com/questions/3448573/is-it-possible-to/3448816#3448816
 * http://kristiannielsen.livejournal.com/6745.html
 *
 * This could be done using an ORM, by loading all of the goals and then
 * getting the latest status for each one - however this means executing 1 +
 * (the number of results) queries. - this single slow(er) query is better than
 * sending lots of queries, although an ORM is easier to understand and could be
 * cached to remove the bottleneck.
 */
function getGoals(MySQLi $db) {
    $sql = <<<SQL
    SELECT
        Goal.id as id,
        Goal.name as name,
        g1.value AS value,
        Goal.value_mask AS mask,
        Goal.created AS created,
        g1.created AS updated
    FROM GoalStatus g1                      -- The first GoalStatus.
    LEFT JOIN Goal ON Goal.id = g1.goal     -- Goal information.
    WHERE EXISTS                            -- Check the goal exists if statuses
        (SELECT id                          -- exist from a deleted goal.
         FROM Goal 
         WHERE id = g1.goal)
    AND g1.created =                        -- Find the highest GS.created, by
        (SELECT MAX(created)                -- comparing the current GS.created to
         FROM GoalStatus g2                 -- the highest in the table.
         WHERE g1.goal = g2.goal);
SQL;

    $goalStmt = $db->prepare($sql);
    $goalStmt->execute();
    $goalStmt->bind_result($id, $name, $value, $mask, $created, $updated);

    $goals = array();

    $i = 0;

    // Fill an array
    while($goalStmt->fetch()) {
        $value = (int) $value;
            
        $goals[] = array(
            "id" => $id,
            "name" => $name,
            "value" => $value,
            "mask" => $mask,
            "value_label" => "",
            "created" => $created,
            "updated" => $updated,
            "width" => ($value > 100) ? 100 : $value
        );
        
        // For done/not done tasks
        if (trim($mask) == "?" && ($value == 1 || $value == 0)) {
            $goals[$i]["value_label"] = ($value == 1) ? "Completed" : "Not completed";
            $goals[$i]["width"] = ($value == 1) ? 100 : 0;
        } else {
            $goals[$i]["value_label"] = str_replace("?", $value, $mask);
        }
        
        $i++;
    }

    $goalStmt->close();
    
    return $goals;
}
