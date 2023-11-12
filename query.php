03-08-2018

CREATE TABLE  `stk_hd_new`.`main_prod_prc_pdf` (
`sl` INT NOT NULL AUTO_INCREMENT ,
`title` VARCHAR( 1000 ) NULL DEFAULT NULL ,
`path` VARCHAR( 500 ) NULL DEFAULT NULL ,
`edt` DATE NOT NULL DEFAULT  '0000-00-00',
`edtm` VARCHAR( 500 ) NULL DEFAULT NULL ,
`eby` VARCHAR( 500 ) NULL DEFAULT NULL ,
PRIMARY KEY (  `sl` )
) ENGINE = MYISAM



06-08-2018


CREATE TABLE  `stk_hd_new`.`main_recv_reg_temp` (
`sl` INT NOT NULL AUTO_INCREMENT ,
`cid` VARCHAR( 300 ) NOT NULL ,
`blno` VARCHAR( 300 ) NOT NULL ,
`dldgr` VARCHAR( 300 ) NOT NULL ,
`paymtd` VARCHAR( 300 ) NOT NULL ,
`refno` VARCHAR( 300 ) NOT NULL ,
`amm` DOUBLE NOT NULL ,
`sman` VARCHAR( 300 ) NOT NULL ,
`eby` VARCHAR( 300 ) NOT NULL ,
PRIMARY KEY (  `sl` )
) ENGINE = MYISAM



ALTER TABLE  `main_recv_reg_temp` ADD  `cldgr` VARCHAR( 300 ) NOT NULL AFTER  `dldgr`

ALTER TABLE  `main_recv_reg_temp` ADD  `brncd` VARCHAR( 300 ) NOT NULL AFTER  `sl`



ALTER TABLE  `main_drcr` ADD  `btyp` VARCHAR( 300 ) NOT NULL AFTER  `ttyp` ,
ADD  `als` VARCHAR( 300 ) NOT NULL AFTER  `btyp` ,
ADD  `ssn` VARCHAR( 300 ) NOT NULL AFTER  `als` ,
ADD  `bsl` VARCHAR( 300 ) NOT NULL AFTER  `ssn` ,
ADD  `blnon` VARCHAR( 300 ) NOT NULL DEFAULT  '' AFTER  `bsl`



10-08-2018

ALTER TABLE  `main_cust` ADD  `pin` VARCHAR( 300 ) NOT NULL AFTER  `cont` ,
ADD  `town` VARCHAR( 300 ) NOT NULL AFTER  `pin` ,
ADD  `distn` VARCHAR( 300 ) NOT NULL AFTER  `town`

11-08-2018
ALTER TABLE  `main_drcr` ADD  `retn_stat` INT NOT NULL DEFAULT  '0' AFTER  `adj_blno`


25-08-2018
ALTER TABLE  `main_drcr_log` ADD  `dsl` VARCHAR( 300 ) NOT NULL DEFAULT  '0' AFTER  `sl`




20-09-2018
ALTER TABLE  `main_slt` ADD  `blno` VARCHAR( 400 ) NULL DEFAULT NULL AFTER  `sl`


ALTER TABLE  `main_order` ADD  `bstat` INT NULL DEFAULT  '0' COMMENT  'Billing Stat' AFTER  `cstat` ,
ADD  `fblno` VARCHAR( 300 ) NULL DEFAULT NULL COMMENT  'Final Bill No' AFTER  `bstat`