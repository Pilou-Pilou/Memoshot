drop trigger insertion

delimiter |
create trigger insertion after update on users
for each row
begin
   if  new.abonnement <>old.abonnement
   then
       update ordre_utilisateur set position=position+1;
        insert into ordre_utilisateur(id_utilisateur,position) values ( new.id,1);
  end if;
end;
|

drop trigger suppresionphoto

delimiter |
create trigger suppresionphoto after delete on album
for each row
begin
  declare nb int;
  select count(*) into nb from users where photo_profil= old.photo;
  if nb<>0
  then
  	update users set photo_profil="../images/default.png" where id=old.id_utilisateur;
  end if;
end;
|




UPDATE ordre_utilisateur SET position=1 WHERE position=
(SELECT * FROM  (SELECT max(position) FROM ordre_utilisateur ) AS tmp)