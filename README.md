# dbcourse
无聊的增删查改
## load导入数据
load data infile "/stu.sql" replace into table s character set utf8 fields terminated by ','  lines terminated by "\r\n";  
load data infile "/sc.sql" replace into table sc character set utf8 fields terminated by ','  lines terminated by "\r\n";