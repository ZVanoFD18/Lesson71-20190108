-------------------------------------------------------------------------------
-- DDL
-- Версия 0
-- В этой версии БД все дропаем и создаем с нуля.
-------------------------------------------------------------------------------

-------------------------------------------------------------------------------
-- sys$db_info
-- Системная тадлица с информацией о БД
DROP TABLE IF EXISTS sys$db_info;
CREATE TABLE sys$db_info (
  [id]          INT CHECK (id == 0),
  [description] VARCHAR(1000),
  [version]     BIGINT,
  [status]      VARCHAR(30) -- UPDATE, LOCK
    CHECK (
      status == 'UPDATE'
      OR
      status == 'LOCK'
    )
);
-------------------------------------------------------------------------------
-- auth$users
-- Пользователи системы
DROP TABLE IF EXISTS auth$users;
CREATE TABLE auth$users (
  [id]            INTEGER
    PRIMARY KEY AUTOINCREMENT COLLATE BINARY,
  [display_name]  varchar2(50)
    UNIQUE                     NOT NULL,
  [login]         VARCHAR(50)
    UNIQUE                     NOT NULL,
  [pass_hash]     VARCHAR(256)
                               NOT NULL,
  -- Основной eMail.
  -- Он главный, через него допустимы все операции над пользователем.
  [e_mail]        VARCHAR(50),
  -- Основной телефон.
  -- Он главный, через него допустимы все операции над пользователем.
  [phone]         VARCHAR(20),
  -- Секретный вопрос
  [change_question] VARCHAR(400),
  -- Ответ на секретный вопрос.
  -- Позволяет управлять аккаунтом.
  [change_answer] VARCHAR(200)
);
-- CREATE UNIQUE INDEX idx_Users_id ON Users (id);
-- CREATE UNIQUE INDEX idx_users_login ON users (LOGIN);

CREATE INDEX idx_users_e_mail
  ON auth$users (
    e_mail COLLATE NOCASE ASC
  );
CREATE INDEX idx_users_phone
  ON auth$users (
    phone COLLATE NOCASE ASC
  );
-------------------------------------------------------------------------------
-- auth$users_email
-- Альтернативные eMail
DROP TABLE IF EXISTS auth$users_email;
CREATE TABLE auth$users_email (
  [id]      INTEGER
    PRIMARY KEY AUTOINCREMENT COLLATE BINARY,
  [user_id] INTEGER,
  [e_mail]  VARCHAR(50)
    NOT NULL,
  is_confirmed varchar(1)
    NOT NULL
    CHECK (
      is_confirmed == 'T'
      OR
      is_confirmed == 'F'
    ),
  FOREIGN KEY (user_id) REFERENCES auth$users (id)
);
-------------------------------------------------------------------------------
-- auth$users_phone
-- Альтернативные телефоны
DROP TABLE IF EXISTS auth$users_phone;
CREATE TABLE auth$users_phone (
  [id]      INTEGER
    PRIMARY KEY AUTOINCREMENT COLLATE BINARY,
  [user_id] INTEGER,
  [phone]  VARCHAR(20)
    NOT NULL,
  is_confirmed varchar(1)
    NOT NULL
    CHECK (
      is_confirmed == 'T'
      OR
      is_confirmed == 'F'
    ),
  FOREIGN KEY (user_id) REFERENCES auth$users (id)
);
-------------------------------------------------------------------------------
-- DML
-- Версия 0
BEGIN TRANSACTION;

-------------------------------------------------------------------------------
-- sys$db_info - START
INSERT INTO sys$db_info (
  id,
  description,
  version,
  status
) VALUES (
  0
  , 'БД для приложения "Блог", по которому будут задачи от академии "ШАГ"'
  , 0
  , 'UPDATE'
);

-------------------------------------------------------------------------------
-- users
INSERT INTO auth$users (
  display_name
  , login
  , pass_hash
  , e_mail
  , phone
  , change_question
  , change_answer
) VALUES (
  'Иванов Иван Иванович'
  , 'ivanov'
  , 'ivanovHash'
  , 'ivanov@gmail.com'
  , '+380971234567890'
  , 'change_question'
  , 'Текст для смены пароля'
), (
  'Иванова МарьЯ Ивановна'
  , 'ivanova'
  , 'ivanovaHash'
  , 'ivanova@gmail.com'
  , '+380971234567890'
  , 'change_question'
  , 'Текст для смены пароля'
);
-------------------------------------------------------------------------------
-- auth$users_email
INSERT into auth$users_email(
  user_id, e_mail, is_confirmed
) VALUES (
  'ivanov', 'ivanov1@gmail.com', 'T'
),(
  'ivanov', 'ivanov2@gmail.com', 'F'
);
-------------------------------------------------------------------------------
-- auth$users_phone
INSERT into auth$users_phone(
  user_id, phone, is_confirmed
) VALUES (
  'ivanov', 'phone1', 'T'
),(
  'ivanov', 'phone2', 'F'
);
-------------------------------------------------------------------------------
-- users_phones

-------------------------------------------------------------------------------
-- sys$db_info - END
UPDATE sys$db_info
SET
  status = 'LOCK';
-------------------------------------------------------------------------------
COMMIT TRANSACTION;