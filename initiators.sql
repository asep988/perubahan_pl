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

 Date: 05/01/2023 13:29:02
*/


-- ----------------------------
-- Table structure for initiators
-- ----------------------------
DROP TABLE IF EXISTS "public"."initiators";
CREATE TABLE "public"."initiators" (
  "id" int8 NOT NULL DEFAULT nextval('initiators_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "pic" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "phone" varchar(255) COLLATE "pg_catalog"."default",
  "address" varchar(255) COLLATE "pg_catalog"."default",
  "user_type" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "nib" varchar(255) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "deleted_at" timestamp(0),
  "agency_type" varchar(255) COLLATE "pg_catalog"."default",
  "province" varchar(255) COLLATE "pg_catalog"."default",
  "district" varchar(255) COLLATE "pg_catalog"."default",
  "pic_role" varchar(255) COLLATE "pg_catalog"."default",
  "logo" varchar(255) COLLATE "pg_catalog"."default",
  "nib_doc_oss" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Uniques structure for table initiators
-- ----------------------------
ALTER TABLE "public"."initiators" ADD CONSTRAINT "initiators_email_unique" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table initiators
-- ----------------------------
ALTER TABLE "public"."initiators" ADD CONSTRAINT "initiators_pkey" PRIMARY KEY ("id");
