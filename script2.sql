DELIMITER $$

CREATE TRIGGER trg_log_insert AFTER INSERT ON customer
FOR EACH ROW

BEGIN

	INSERT INTO log_customer(customer,operation,operation_date,last_id,new_id,last_document,new_document,last_active,new_active)
	VALUES
	(new.id, 'INSERT', now(), null, new.id, null,new.document,null,new.active);

END$$

DELIMITER ;





DELIMITER $$

CREATE TRIGGER trg_log_update AFTER UPDATE ON customer
FOR EACH ROW

BEGIN

	INSERT INTO log_customer(customer,operation,operation_date,last_id,new_id,last_document,new_document,last_active,new_active)
	VALUES
	(old.id, 'UPDATE', now(), old.id, new.id, old.document,new.document,old.active,new.active);

END$$

DELIMITER ;




DELIMITER $$

CREATE TRIGGER trg_log_delete AFTER DELETE ON customer
FOR EACH ROW

BEGIN

	INSERT INTO log_customer(customer,operation,operation_date,last_id,new_id,last_document,new_document,last_active,new_active)
	VALUES
	(old.id, 'DELETE', now(), old.id, null, old.document,null,old.active,null);

END$$

DELIMITER ;



