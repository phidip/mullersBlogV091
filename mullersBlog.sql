drop database mullersBlog;

create database mullersBlog;
use mullersBlog;

create table shadow (
    alias varchar(16) not null,
    salt int not null,
    pwd char(128) not null,
    primary key(alias)
);

create table passwd(
    alias varchar(16) not null,
    type enum('A', 'O') not null default 'O',
    lastonline datetime not null,
    lastattempt time not null,
    primary key(alias),
    foreign key(alias) references shadow(alias)
);

create table post(
    author varchar(16) not null,
    clocked datetime not null,
    content varchar(4096) not null,
    subject varchar(64),
    primary key(author, clocked),
    foreign key(author) references passwd(alias)
);

create table thread(
    authororg varchar(16) not null,
    clockedorg datetime not null,
    author varchar(16) not null,
    clocked datetime not null,
    primary key(author, clocked),
    foreign key(author, clocked) references post(author, clocked),
    foreign key(authororg, clockedorg) references post(author, clocked)
);

create table tags(
    author varchar(16) not null,
    clocked datetime not null,
    sno int not null auto_increment,
    tag varchar(32) not null,
    primary key(sno),
    foreign key(author, clocked) references post(author, clocked)
);

create table resource(
    id int not null auto_increment,
    mimetype varchar(32) not null,
    alttext varchar(96) not null,
    caption varchar(96) not null,
    resourceitself blob not null,
    avatar boolean not null default false,
    copyrightrestricted boolean not null default true,
    user varchar(16) not null,
    primary key(id),
    foreign key(user) references passwd(alias)
);

create table refers(
    id int not null,
    author varchar(16) not null,
    clocked datetime not null,
    primary key(author, clocked, id),
    foreign key(author, clocked) references post(author, clocked),
    foreign key(id) references resource(id)
);

grant select on shadow to nobody;
grant select on passwd to nobody;
grant select,insert on post to nobody;
grant select on thread to nobody;
grant select,insert on tags to nobody;
grant select,insert on resource to nobody;
grant select on refers to nobody;
