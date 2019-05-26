CREATE TABLE offices_dup LIKE offices;

---------------------------------------------------------------------------------------------------

SELECT
  tm.task_id,
  COUNT(tm.task_id) AS temp_task_repeated,
  frtm.task_repeated
FROM
  trip_master tm
  INNER JOIN fleet_regular_task_master frtm
    ON frtm.`fleet_regular_task_id` = tm.`task_id`
WHERE tm.`trip_status` = 3
GROUP BY tm.task_id

---------------------------------------------------------------------------------------------------

UPDATE
  fleet_regular_task_master frtm
  INNER JOIN
    (SELECT
      tm.task_id,
      COUNT(tm.task_id) AS xxx_created_trip,
      frtm.trip_created
    FROM
      trip_master tm
      INNER JOIN fleet_regular_task_master frtm
        ON frtm.`fleet_regular_task_id` = tm.`task_id`
    GROUP BY tm.task_id) AS zzz
    ON frtm.fleet_regular_task_id = zzz.task_id SET frtm.trip_created = zzz.xxx_created_trip

---------------------------------------------------------------------------------------------------

UPDATE
  fleet_regular_task_master frtm
  INNER JOIN
    (SELECT
      tm.task_id,
      COUNT(tm.task_id) AS temp_task_repeated,
      frtm.task_repeated
    FROM
      trip_master tm
      INNER JOIN fleet_regular_task_master frtm
        ON frtm.`fleet_regular_task_id` = tm.`task_id`
    WHERE tm.`trip_status` = 3
    GROUP BY tm.task_id) AS zzz
    ON frtm.fleet_regular_task_id = zzz.task_id SET frtm.task_repeated = zzz.temp_task_repeated

---------------------------------------------------------------------------------------------------

SELECT
  DATEDIFF(
    DATE('2019-05-31'),
    DATE(tm.`trip_start_time`)
  ) AS remaining_days,
  frtm.trip_created,
  frtm.task_repeat_no,
  tm.*
FROM
  trip_master tm
  INNER JOIN fleet_regular_task_master frtm
    ON frtm.`fleet_regular_task_id` = tm.`task_id`
WHERE tm.`trip_master_id` IN
  (SELECT
    MAX(tm.`trip_master_id`)
  FROM
    trip_master tm
  GROUP BY tm.`task_id`)
  AND tm.`task_id` >= 92
ORDER BY tm.`task_id`

---------------------------------------------------------------------------------------------------

UPDATE
  fleet_regular_task_master frtm
  INNER JOIN
    (SELECT
      DATEDIFF(
        DATE('2019-05-31'),
        DATE(tm.`trip_start_time`)
      ) AS remaining_days,
      frtm.trip_created,
      frtm.task_repeat_no,
      tm.*
    FROM
      trip_master tm
      INNER JOIN fleet_regular_task_master frtm
        ON frtm.`fleet_regular_task_id` = tm.`task_id`
    WHERE tm.`trip_master_id` IN
      (SELECT
        MAX(tm.`trip_master_id`)
      FROM
        trip_master tm
      GROUP BY tm.`task_id`)
      AND tm.`task_id` >= 92
    ORDER BY tm.`task_id`) AS zzz
    ON frtm.fleet_regular_task_id = zzz.task_id SET frtm.task_repeat_no = (
      zzz.remaining_days + zzz.trip_created
    )
    
    
    
---------------------------------------------------------------------------------------------------


