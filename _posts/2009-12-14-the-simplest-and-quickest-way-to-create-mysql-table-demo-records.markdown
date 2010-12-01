---
layout: post
title: "The simplest and quickest way to create mysql table demo records."
---

<p class='meta'>2009-12-14 23:28:59</p>

Take animals table as example,
Field        Type     Extra
-----------  ------------ 
id    mediumint(8)  auto_increment
animal_type  varchar(25)        
animal_name  varchar(25)   

Create one records in this table.
Step1. insert into animals(`animal_type`, `animal_name`) values('dingo', 'cat');
Step2:
insert into animals(`animal_type`, `animal_name`) select animal_type, animal_name from animals;

Re-run the step2 serval times, you will find the records was increased as geometric progressions.