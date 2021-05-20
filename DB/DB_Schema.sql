CREATE TABLE `users`
(
    `id`         bigint unsigned                         NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `login_type` int                                     NOT NULL DEFAULT '0',
    `created_at` timestamp                               NULL     DEFAULT NULL,
    `updated_at` timestamp                               NULL     DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `collects`
(
    `id`                  bigint unsigned                         NOT NULL AUTO_INCREMENT,
    `collect_date`        date                                    NOT NULL,
    `name`                char(255) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `general_score`       char(255) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `general_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `love_score`          char(255) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `love_description`    varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `career_score`        char(255) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `career_description`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `money_score`         char(255) COLLATE utf8mb4_unicode_ci    NOT NULL,
    `money_description`   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`          datetime                                NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `collect_logs`
(
    `id`         bigint unsigned                                       NOT NULL AUTO_INCREMENT,
    `message`    text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` datetime                                              NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;