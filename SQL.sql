/* Initial Database Setup. */

CREATE DATABASE IF NOT EXISTS ci_portfolio;

CREATE TABLE IF NOT EXISTS ci_portfolio.projects (
    id                  INT(11)         NOT NULL AUTO_INCREMENT,
    title               VARCHAR(128)    NOT NULL,
    description         TEXT            NOT NULL,
    short_description   VARCHAR(255)    NOT NULL,
    image               VARCHAR(255)    NOT NULL,
    thumb               VARCHAR(255)    NOT NULL,
    featured            CHAR(1)         NOT NULL DEFAULT 'f',
    date                TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    source              TEXT            NOT NULL,
    github              VARCHAR(255)    NOT NULL,
    demo                VARCHAR(255)    NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ci_portfolio.posts (
    id          INT(11)         NOT NULL AUTO_INCREMENT,
    title       VARCHAR(128)    NOT NULL,
    description VARCHAR(255)    NOT NULL,
    content     TEXT            NOT NULL,
    image       VARCHAR(255)    NOT NULL,
    thumbnail   VARCHAR(255)    NOT NULL,
    date        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ci_portfolio.images (
    filename    VARCHAR(255) NOT NULL,
    alt         VARCHAR(128) NOT NULL,
    project     INT(11)      NOT NULL,
    PRIMARY KEY (filename, project)
);

CREATE TABLE IF NOT EXISTS ci_portfolio.tags (
    tag     VARCHAR(32) NOT NULL,
    project INT(11)     NOT NULL,
    PRIMARY KEY (tag, project)
);

/* Database Modifications */
ALTER TABLE ci_portfolio.images
    ADD thumbnail VARCHAR(255) AFTER filename;

/* Populate with Test Data */