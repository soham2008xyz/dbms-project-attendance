-- Tables
CREATE TABLE teachers (
  teacher_id    NUMBER NOT NULL PRIMARY KEY,
  teacher_code  VARCHAR2(3) NOT NULL,
  teacher_name  VARCHAR2(50) NOT NULL,
  teacher_email VARCHAR2(50),
  teacher_phone VARCHAR2(20)
);

CREATE TABLE subjects (
  subject_id    NUMBER NOT NULL PRIMARY KEY,
  subject_code  VARCHAR2(6) NOT NULL,
  subject_name  VARCHAR2(50) NOT NULL
);

CREATE TABLE batches (
  batch_id            NUMBER NOT NULL PRIMARY KEY,
  batch_year_passout  NUMBER NOT NULL,
  batch_stream        VARCHAR2(25) NOT NULL
);

CREATE TABLE sections (
  section_id    NUMBER NOT NULL PRIMARY KEY,
  batch_id      NUMBER NOT NULL,
  section_name  VARCHAR2(3) NOT NULL
);

CREATE TABLE students (
  student_id        NUMBER NOT NULL PRIMARY KEY,
  student_roll      NUMBER NOT NULL,
  section_id        NUMBER NOT NULL,
  student_name      VARCHAR2(50) NOT NULL,
  student_email     VARCHAR2(50),
  student_phone     VARCHAR2(20),
  student_semester  NUMBER NOT NULL
);

CREATE TABLE schedules (
  schedule_id       NUMBER NOT NULL PRIMARY KEY,
  subject_id        NUMBER NOT NULL,
  teacher_id        NUMBER NOT NULL,
  section_id        NUMBER NOT NULL,
  schedule_weekday  VARCHAR2(25) NOT NULL,
  schedule_period   NUMBER NOT NULL
);

CREATE TABLE attendance_records (
  attendance_record_id    NUMBER NOT NULL PRIMARY KEY,
  student_id              NUMBER NOT NULL,
  schedule_id             NUMBER NOT NULL,
  attendance_record_value NUMBER(1) DEFAULT 1,
  attendance_record_date  DATE NOT NULL
);

-- Constraints
ALTER TABLE sections ADD CONSTRAINT sec_batch_id_fkey
FOREIGN KEY (batch_id)
  REFERENCES batches (batch_id)
ON DELETE CASCADE;

ALTER TABLE students ADD CONSTRAINT stu_section_id_fkey
FOREIGN KEY (section_id)
  REFERENCES sections (section_id)
ON DELETE CASCADE;

ALTER TABLE schedules ADD CONSTRAINT sch_subject_id_fkey
FOREIGN KEY (subject_id)
  REFERENCES subjects (subject_id)
ON DELETE CASCADE;

ALTER TABLE schedules ADD CONSTRAINT sch_teacher_id_fkey
FOREIGN KEY (teacher_id)
  REFERENCES teachers (teacher_id)
ON DELETE CASCADE;

ALTER TABLE schedules ADD  CONSTRAINT sch_section_id_fkey
FOREIGN KEY (section_id)
  REFERENCES sections (section_id)
ON DELETE CASCADE;

ALTER TABLE attendance_records ADD CONSTRAINT arec_student_id_fkey
FOREIGN KEY (student_id)
  REFERENCES students (student_id)
ON DELETE CASCADE;

ALTER TABLE attendance_records ADD CONSTRAINT arec_schedule_id_fkey
FOREIGN KEY (schedule_id)
  REFERENCES schedules (schedule_id)
ON DELETE CASCADE;

-- Sequences
CREATE SEQUENCE teachers_teacher_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

CREATE SEQUENCE subjects_subject_id_seq
MINVALUE 10 START WITH 10 INCREMENT BY 10 NOCACHE;

CREATE SEQUENCE batches_batch_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

CREATE SEQUENCE sections_section_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

CREATE SEQUENCE students_student_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

CREATE SEQUENCE schedules_schedule_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

CREATE SEQUENCE attendance_records_id_seq
MINVALUE 1 START WITH 1 INCREMENT BY 1 NOCACHE;

-- Triggers
CREATE OR REPLACE TRIGGER trig_teacher_autoincrement
BEFORE INSERT ON teachers
FOR EACH ROW
  BEGIN
    :new.teacher_id := teachers_teacher_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_subject_autoincrement
BEFORE INSERT ON subjects
FOR EACH ROW
  BEGIN
    :new.subject_id := subjects_subject_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_batch_autoincrement
BEFORE INSERT ON batches
FOR EACH ROW
  BEGIN
    :new.batch_id := batches_batch_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_section_autoincrement
BEFORE INSERT ON sections
FOR EACH ROW
  BEGIN
    :new.section_id := sections_section_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_student_autoincrement
BEFORE INSERT ON students
FOR EACH ROW
  BEGIN
    :new.student_id := students_student_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_schedule_autoincrement
BEFORE INSERT ON schedules
FOR EACH ROW
  BEGIN
    :new.schedule_id := schedules_schedule_id_seq.nextval;
  END;
/

CREATE OR REPLACE TRIGGER trig_att_record_autoincrement
BEFORE INSERT ON attendance_records
FOR EACH ROW
  BEGIN
    :new.attendance_record_id := attendance_records_id_seq.nextval;
  END;
/

-- Views
CREATE OR REPLACE VIEW all_class_routines AS
  SELECT
    SCHEDULES.SCHEDULE_ID,
    SCHEDULES.SCHEDULE_WEEKDAY,
    SCHEDULES.SCHEDULE_PERIOD,
    SCHEDULES.SECTION_ID,
    TEACHERS.TEACHER_ID,
    TEACHERS.TEACHER_CODE,
    TEACHERS.TEACHER_NAME,
    SUBJECTS.SUBJECT_ID,
    SUBJECTS.SUBJECT_CODE,
    SUBJECTS.SUBJECT_NAME
  FROM SCHEDULES
    INNER JOIN TEACHERS
      ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID
    INNER JOIN SUBJECTS
      ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
  ORDER BY SCHEDULE_WEEKDAY ASC, SCHEDULE_PERIOD ASC
  WITH READ ONLY;
/

CREATE OR REPLACE VIEW all_teacher_routines AS
  SELECT
    SCHEDULES.SCHEDULE_ID,
    SCHEDULES.TEACHER_ID,
    SCHEDULES.SCHEDULE_WEEKDAY,
    SCHEDULES.SCHEDULE_PERIOD,
    SECTIONS.SECTION_ID,
    SECTIONS.SECTION_NAME,
    BATCHES.BATCH_ID,
    BATCHES.BATCH_STREAM,
    BATCHES.BATCH_YEAR_PASSOUT,
    SUBJECTS.SUBJECT_ID,
    SUBJECTS.SUBJECT_CODE,
    SUBJECTS.SUBJECT_NAME
  FROM SCHEDULES
    INNER JOIN SECTIONS
      ON SECTIONS.SECTION_ID = SCHEDULES.SECTION_ID
    INNER JOIN BATCHES
      ON BATCHES.BATCH_ID = SECTIONS.BATCH_ID
    INNER JOIN SUBJECTS
      ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
  ORDER BY SCHEDULE_WEEKDAY ASC, SCHEDULE_PERIOD ASC
  WITH READ ONLY;
/

CREATE OR REPLACE VIEW attendance_list AS
  SELECT
    REC.ATTENDANCE_RECORD_DATE,
    REC.NUM_STUDENTS,
    REC.SCHEDULE_ID,
    SCHEDULES.SCHEDULE_WEEKDAY,
    SCHEDULES.SCHEDULE_PERIOD,
    TEACHERS.TEACHER_ID,
    TEACHERS.TEACHER_CODE,
    TEACHERS.TEACHER_NAME,
    SUBJECTS.SUBJECT_ID,
    SUBJECTS.SUBJECT_CODE,
    SUBJECTS.SUBJECT_NAME,
    SECTIONS.SECTION_ID,
    SECTIONS.SECTION_NAME,
    BATCHES.BATCH_ID,
    BATCHES.BATCH_YEAR_PASSOUT,
    BATCHES.BATCH_STREAM
  FROM (
         SELECT
           ATTENDANCE_RECORD_DATE,
           COUNT(ATTENDANCE_RECORD_ID) AS NUM_STUDENTS,
           ATTENDANCE_RECORDS.SCHEDULE_ID FROM ATTENDANCE_RECORDS
         GROUP BY
           ATTENDANCE_RECORD_DATE,
           ATTENDANCE_RECORDS.SCHEDULE_ID
       ) REC
    INNER JOIN SCHEDULES
      ON SCHEDULES.SCHEDULE_ID = REC.SCHEDULE_ID
    INNER JOIN TEACHERS
      ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID
    INNER JOIN SUBJECTS
      ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
    INNER JOIN SECTIONS
      ON SECTIONS.SECTION_ID = SCHEDULES.SECTION_ID
    INNER JOIN BATCHES
      ON BATCHES.BATCH_ID = SECTIONS.BATCH_ID
  WITH READ ONLY;
/

-- Procedures
CREATE OR REPLACE PROCEDURE add_teacher
  (
    teacher_code	teachers.teacher_code%type,
    teacher_name	teachers.teacher_name%type,
    teacher_email	teachers.teacher_email%type,
    teacher_phone	teachers.teacher_phone%type
  )
IS
  BEGIN
    INSERT INTO teachers ( teacher_code, teacher_name, teacher_email, teacher_phone )
    VALUES ( teacher_code, teacher_name, teacher_email, teacher_phone );
  END;
/

CREATE OR REPLACE PROCEDURE add_subject
  (
    subject_code	subjects.subject_code%type,
    subject_name	subjects.subject_name%type
  )
IS
  BEGIN
    INSERT INTO subjects ( subject_code, subject_name )
    VALUES ( subject_code, subject_name );
  END;
/

CREATE OR REPLACE PROCEDURE add_batch
  (
    batch_year_passout	batches.batch_year_passout%type,
    batch_stream				batches.batch_stream%type
  )
IS
  BEGIN
    INSERT INTO batches ( batch_year_passout, batch_stream )
    VALUES ( batch_year_passout, batch_stream );
  END;
/

CREATE OR REPLACE PROCEDURE add_section
  (
    batch_id			sections.batch_id%type,
    section_name	sections.section_name%type
  )
IS
  BEGIN
    INSERT INTO sections ( batch_id, section_name )
    VALUES ( batch_id, section_name );
  END;
/

CREATE OR REPLACE PROCEDURE add_student
  (
    section_id				students.section_id%type,
    student_name			students.student_name%type,
    student_email			students.student_email%type,
    student_phone			students.student_phone%type,
    student_semester	students.student_semester%type
  )
IS
  BEGIN
    INSERT INTO students ( section_id, student_name, student_email, student_phone, student_semester )
    VALUES ( section_id, student_name, student_email, student_phone, student_semester );
  END;
/

CREATE OR REPLACE PROCEDURE add_schedule
  (
    subject_id				schedules.subject_id%type,
    teacher_id				schedules.teacher_id%type,
    section_id				schedules.section_id%type,
    schedule_weekday	schedules.schedule_weekday%type,
    schedule_period		schedules.schedule_period%type
  )
IS
  BEGIN
    INSERT INTO schedules ( subject_id, teacher_id, section_id, schedule_weekday, schedule_period )
    VALUES ( subject_id, teacher_id, section_id,schedule_weekday, schedule_period );
  END;
/

CREATE OR REPLACE PROCEDURE add_attendance_record
  (
    student_id							attendance_records.student_id%type,
    schedule_id							attendance_records.schedule_id%type,
    attendance_record_value	attendance_records.attendance_record_value%type,
    attendance_record_date	attendance_records.attendance_record_date%type
  )
IS
  BEGIN
    INSERT INTO attendance_records ( student_id, schedule_id, attendance_record_value, attendance_record_date )
    VALUES ( student_id, schedule_id, attendance_record_value, attendance_record_date );
  END;
/

CREATE OR REPLACE PROCEDURE remove_teacher
  (
    t_id	teachers.teacher_id%type
  )
IS
  BEGIN
    DELETE FROM teachers
    WHERE teacher_id = t_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_subject
  (
    s_id	subjects.subject_id%type
  )
IS
  BEGIN
    DELETE FROM subjects
    WHERE subject_id = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_batch
  (
    b_id	batches.batch_id%type
  )
IS
  BEGIN
    DELETE FROM batches
    WHERE batch_id = b_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_section
  (
    s_id	sections.section_id%type
  )
IS
  BEGIN
    DELETE FROM sections
    WHERE section_id = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_student
  (
    s_id	students.student_id%type
  )
IS
  BEGIN
    DELETE FROM students
    WHERE student_id = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_schedule
  (
    s_id	schedules.schedule_id%type
  )
IS
  BEGIN
    DELETE FROM schedules
    WHERE schedule_id = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE remove_attendance_record
  (
    a_id	attendance_records.attendance_record_id%type
  )
IS
  BEGIN
    DELETE FROM attendance_records
    WHERE attendance_record_id = a_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_teacher
  (
    t_id		teachers.teacher_id%type,
    t_code	teachers.teacher_code%type,
    t_name	teachers.teacher_name%type,
    t_email	teachers.teacher_email%type,
    t_phone	teachers.teacher_phone%type
  )
IS
  BEGIN
    UPDATE teachers
    SET
      teacher_code  = t_code,
      teacher_name  = t_name,
      teacher_email = t_email,
      teacher_phone = t_phone
    WHERE
      teacher_id    = t_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_subject
  (
    s_id	  subjects.subject_id%type,
    s_code	subjects.subject_code%type,
    s_name	subjects.subject_name%type
  )
IS
  BEGIN
    UPDATE subjects
    SET
      subject_code  = s_code,
      subject_name  = s_name
    WHERE
      subject_id    = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_batch
  (
    b_id	          batches.batch_id%type,
    b_year_passout	batches.batch_year_passout%type,
    b_stream				batches.batch_stream%type
  )
IS
  BEGIN
    UPDATE batches
    SET
      batch_year_passout  = b_year_passout,
      batch_stream        = b_stream
    WHERE
      batch_id            = b_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_section
  (
    s_id		sections.section_id%type,
    b_id		sections.batch_id%type,
    s_name	sections.section_name%type
  )
IS
  BEGIN
    UPDATE sections
    SET
      batch_id      = b_id,
      section_name  = s_name
    WHERE
      section_id    = s_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_student
  (
    st_id       students.student_id%type,
    s_id		    students.section_id%type,
    s_name			students.student_name%type,
    s_email			students.student_email%type,
    s_phone			students.student_phone%type,
    s_semester	students.student_semester%type
  )
IS
  BEGIN
    UPDATE students
    SET section_id      = s_id,
      student_name      = s_name,
      student_email     = s_email,
      student_phone     = s_phone,
      student_semester  = s_semester
    WHERE
      student_id        = st_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_schedule
  (
    sch_id		schedules.schedule_id%type,
    s_id			schedules.subject_id%type,
    t_id			schedules.teacher_id%type,
    sec_id		schedules.section_id%type,
    s_weekday	schedules.schedule_weekday%type,
    s_period	schedules.schedule_period%type
  )
IS
  BEGIN
    UPDATE schedules
    SET
      subject_id        = s_id,
      teacher_id        = t_id,
      section_id        = sec_id,
      schedule_weekday  = s_weekday,
      schedule_period   = s_period
    WHERE
      schedule_id       = sch_id;
  END;
/

CREATE OR REPLACE PROCEDURE edit_attendance_record
  (
    a_id 	  attendance_records.attendance_record_id%type,
    st_id		attendance_records.student_id%type,
    sch_id	attendance_records.schedule_id%type,
    a_value	attendance_records.attendance_record_value%type,
    a_date	attendance_records.attendance_record_date%type
  )
IS
  BEGIN
    UPDATE attendance_records
    SET
      student_id                = st_id,
      schedule_id               = sch_id,
      attendance_record_value   = a_value,
      attendance_record_date    = a_date
    WHERE
      attendance_record_id      = a_id;
  END;
/