select post.author, post.clocked, post.subject, post.content
from post left join thread 
on thread.author = post.author 
and thread.clocked = post.clocked 
order by post.subject, post.clocked;