CREATE TABLE client (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `client_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '接入客户端ID',
    `client_secret` VARCHAR(256) NOT NULL DEFAULT '' COMMENT '客户端密钥',
    `client_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '客户端名称',
    `enable` tinyint(4) NOT NULL DEFAULT 1 COMMENT '客户端状态',
    `create_time` BIGINT(20) NOT NULL DEFAULT 0 COMMENT '客户端创建时间',
    PRIMARY KEY (`id`),
    KEY `client_id` (`client_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT '接入平台表';


CREATE TABLE client_user (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `client_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '接入客户端ID',
    `user_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户id',
    `enable` tinyint(4) NOT NULL DEFAULT 1 COMMENT '关联状态',
    `create_time` BIGINT(20) NOT NULL DEFAULT 0 COMMENT '关联创建时间',
    PRIMARY KEY (`id`),
    KEY `client_id` (`client_id`),
    KEY `user_id` (`user_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT '接入平台用户关联表';


CREATE TABLE user_basic (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `user_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户id',
    `user_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户名',
    `user_secret` VARCHAR(512) NOT NULL DEFAULT '' COMMENT '用户密钥',
    `user_email`  VARCHAR(128) NOT NULL DEFAULT '' COMMENT '用户邮箱',
    `user_phone` VARCHAR(128) DEFAULT '' COMMENT '用户手机号',
    `ext` TEXT  COMMENT '拓展信息',
    `enable` TINYINT(4) NOT NULL DEFAULT 1 COMMENT '用户状态',
    `create_time` BIGINT(20) NOT NULL DEFAULT 0 COMMENT '用户创建时间',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `user_email` (`user_email`),
    KEY `user_phone` (`user_phone`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT '用户关联表';

CREATE TABLE client_redirect_uri (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `client_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '平台ID',
    `redirent_uri` TEXT NOT NULL COMMENT '跳转字段',
    `enable` TINYINT(4) NOT NULL DEFAULT 1 COMMENT '用户状态',
    `create_time` BIGINT(20) NOT NULL DEFAULT 0 COMMENT '用户创建时间',
    PRIMARY KEY (`id`),
    KEY `client_id` (`client_id`)
    
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT '平台注册跳转表';

CREATE TABLE client_scope (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `client_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '平台ID',
    `scope_id` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '授权内容',
    `enable` TINYINT(4) NOT NULL DEFAULT 1 COMMENT '用户状态',
    `create_time` BIGINT(20) NOT NULL DEFAULT 0 COMMENT '用户创建时间',
    PRIMARY KEY (`id`),
    KEY `client_id` (`client_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT '平台注册授权内容表';

