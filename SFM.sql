create table fleets
(
  id         int auto_increment
    primary key,
  fleet_name varchar(100) not null,
  details    longtext     null,
  duty_id    smallint(6)  not null,
  constraint UNIQ_F31645263A1F9EC1
  unique (duty_id)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table messages
(
  id       int auto_increment
    primary key,
  frm      varchar(255) not null,
  too      varchar(255) not null,
  sent     datetime     null,
  received datetime     null,
  content  longtext     null,
  isRead   tinyint(1)   not null
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table roles
(
  id   int auto_increment
    primary key,
  name varchar(255) not null,
  constraint UNIQ_B63E2EC75E237E06
  unique (name)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table ships
(
  id        int auto_increment
    primary key,
  ship_name varchar(100) not null,
  email     varchar(255) not null,
  duty_id   smallint(6)  not null,
  constraint UNIQ_27F71B31FC01AD47
  unique (ship_name),
  constraint UNIQ_27F71B31E7927C74
  unique (email)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table users
(
  id        int auto_increment
    primary key,
  duty_id   smallint(6)  not null,
  username  varchar(100) not null,
  password  varchar(255) not null,
  email     varchar(255) not null,
  ship_name varchar(100) not null,
  ship_type varchar(255) not null,
  position  varchar(100) not null,
  constraint UNIQ_1483A5E93A1F9EC1
  unique (duty_id),
  constraint UNIQ_1483A5E9F85E0677
  unique (username),
  constraint UNIQ_1483A5E9E7927C74
  unique (email),
  constraint UNIQ_1483A5E9FC01AD47
  unique (ship_name)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create table users_roles
(
  user_id int not null,
  role_id int not null,
  primary key (user_id, role_id),
  constraint FK_51498A8EA76ED395
  foreign key (user_id) references users (id),
  constraint FK_51498A8ED60322AC
  foreign key (role_id) references roles (id)
)
  engine = InnoDB
  collate = utf8_unicode_ci;

create index IDX_51498A8EA76ED395
  on users_roles (user_id);

create index IDX_51498A8ED60322AC
  on users_roles (role_id);

