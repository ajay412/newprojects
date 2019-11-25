
<?php
sql queries
max salary
select max(salary)from emp;
select min(salary)from emp;
second highest salaey
SELECT name from emp where salary=(select max(salary)from emp where salary<>(select max(salary)from emp));

group by

select dept,count(dept)from dept group by(dept);
 group by showing less than 2
SELECT dept from dept group by (dept) having count(*) <2
display name of employee group by
ELECT name from dept where(dept) in (SELECT dept from dept group by (dept) having count(*) <2);
?>
