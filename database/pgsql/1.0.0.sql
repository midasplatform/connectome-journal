CREATE TABLE journal_journal (
  journal_id serial PRIMARY KEY,
  community_id bigint NOT NULL,
  enabled int NOT NULL DEFAULT '1',
);

CREATE TABLE `journal_issue` (
  issue_id serial PRIMARY KEY,
  journal_id bigint(20) NOT NULL,
  folder_id bigint(20) NOT NULL,
);

CREATE TABLE journal_paper (
  paper_id serial PRIMARY KEY,
  issue_id bigint NOT NULL,
  folder_id bigint NOT NULL,
  title text NOT NULL,
  abstract text NOT NULL,
  paper_item_id bigint NOT NULL,
  status bigint NOT NULL,
  script_item_id bigint
);

CREATE TABLE journal_author (
  author_id serial PRIMARY KEY,
  paper_id bigint NOT NULL,
  author_firstname text NOT NULL,
  author_middlename text,
  author_lastname text NOT NULL,
  author_order bigint NOT NULL
);

CREATE TABLE journal_keyword (
  keyword_id serial PRIMARY KEY,
  paper_id bigint NOT NULL,
  keyword text NOT NULL,
  keyword_order bigint NOT NULL,
  PRIMARY KEY (`keyword_id`)
);