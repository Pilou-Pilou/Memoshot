drop trigger insertion

delimiter |
create trigger insertion after insert on abonnement
for each row
begin
  declare id_util int;
  select id into id_util from users where abonnement= new.id_abonnement;
  update ordre_utilisateur set position=position+1;
  insert into ordre_utilisateur(id_utilisateur,position) values (id_util,1);
end;
|