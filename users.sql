/*
 Navicat Premium Data Transfer

 Source Server         : Amdalnet-dev
 Source Server Type    : PostgreSQL
 Source Server Version : 140006
 Source Host           : localhost:5432
 Source Catalog        : amdalnet
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 140006
 File Encoding         : 65001

 Date: 05/01/2023 13:28:49
*/


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int8 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email_verified_at" timestamp(0),
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "remember_token" varchar(100) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "avatar" varchar COLLATE "pg_catalog"."default",
  "oss_username" varchar(255) COLLATE "pg_catalog"."default",
  "active" int4 NOT NULL DEFAULT 0,
  "access_token" text COLLATE "pg_catalog"."default",
  "refresh_token" text COLLATE "pg_catalog"."default",
  "is_email_verified" bool NOT NULL DEFAULT true
)
;

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_unique" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");
