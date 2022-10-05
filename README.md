# Rest API for task-board

# baseurl = https://taskboard.orbitsource.net/api/v1/todo

# demo site: https://task-board.tamzidpeace.vercel.app/

# API Instructions 

@host = https://taskboard.orbitsource.net/api/v1/todo/


### ==============================
###           API
### ==============================

### get all todo
GET {{host}}/ HTTP/1.1
content-type: application/json



### add todo
POST {{host}}add HTTP/1.1
content-type: application/json

{
    "task": "task4"
}


### change todo status[todo, in_progress, done. both field required]
POST {{host}}change-status HTTP/1.1
content-type: application/json

{
    "id": 23,
    "status": "done"
}
