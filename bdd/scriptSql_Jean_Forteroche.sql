#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        id               int (11) Auto_increment  NOT NULL ,
        username         Varchar (20) NOT NULL ,
        mail             Varchar (70) NOT NULL ,
        password         Varchar (50) NOT NULL ,
        inscription_date Date NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Chapters
#------------------------------------------------------------

CREATE TABLE Chapters(
        id            int (11) Auto_increment  NOT NULL ,
        title         Varchar (150) NOT NULL ,
        chapter_img   Varchar (250) NOT NULL ,
        chapter_texte Text NOT NULL ,
        chapter_date  Date NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comments
#------------------------------------------------------------

CREATE TABLE Comments(
        id           int (11) Auto_increment  NOT NULL ,
        comment_text Text NOT NULL ,
        comment_date Date NOT NULL ,
        id_Chapters  Int NOT NULL ,
        id_Users     Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE Comments ADD CONSTRAINT FK_Comments_id_Chapters FOREIGN KEY (id_Chapters) REFERENCES Chapters(id);
ALTER TABLE Comments ADD CONSTRAINT FK_Comments_id_Users FOREIGN KEY (id_Users) REFERENCES Users(id);
