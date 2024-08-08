-- количество проектов
SELECT COUNT(*) AS total_projects
FROM project;
--количество разработчиков
SELECT COUNT(*) AS total_developers
FROM developer;
--средний возраст разработчиков
SELECT AVG(EXTRACT(YEAR FROM AGE(birthday))) AS average_age
FROM developer;
--количество статусов в проектах
SELECT status, COUNT(*) AS count
FROM project
GROUP BY status;
--количество статусов у разработчиков
SELECT status, COUNT(*) AS count
FROM developer
GROUP BY status;
--список проектов с количеством разработчиков
SELECT p.name AS project_name, COUNT(d.id) AS developer_count
FROM project p
         LEFT JOIN developer d ON p.id = d.project_id
GROUP BY p.id, p.name;
--список разработчиков с их проектами
SELECT d.full_name AS developer_name, p.name AS project_name
FROM developer d
         JOIN project p ON d.project_id = p.id;
-- проекты с их статусом и количесвтом разработчиков
SELECT p.name AS project_name, p.status AS project_status, COUNT(d.id) AS developer_count
FROM project p
         LEFT JOIN developer d ON p.id = d.project_id
GROUP BY p.id, p.name, p.status;
-- средняя зарплата разработчиков
SELECT AVG(salary) AS average_salary
FROM developer;