CREATE TABLE qes.inputdata (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
token VARCHAR(40) NOT NULL,
var_a INT NOT NULL,
var_b INT NOT NULL,
var_c INT NOT NULL, 
received_req INT NOT NULL,
created DATETIME,
modified DATETIME
);

CREATE TABLE qes.outputdata (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
inputdata_id INT UNSIGNED NOT NULL,
var_x1 FLOAT NULL,
var_x2 FLOAT NULL,
message VARCHAR(100) NULL,
created DATETIME,
modified DATETIME,
FOREIGN KEY inputdata_key(inputdata_id) REFERENCES qes.inputdata(id)
);

