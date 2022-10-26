# CRUD API


This app is all about a CRUD API using Laravel.

The core functionality of the API:

1. Display a list of posts.
2. Delete a specific post.
3. Add a brand new post.
4. Update an existing post.


## Getting started

### Step 1: Required software installation

For the required software installation, you just have to open your terminal on the current folder and type in `composer install`


### Step 2: Set up database

1. Create a brand new database with the name: `restapilaravel`

2. Then in terminal run:

```bash
php artisan migrate:fresh
```

### Step 3: Start the server

Start the Server

```bash
php artisan serve
```



## API documentation

### Getting started

- Base URL: At present this app can only be run locally and is not hosted as a base URL. The backend app is hosted at the default, `http://127.0.0.1:8000/`; 
- Authentication: This version of the application does not require authentication or API keys.

### Error Handling

Errors are returned as JSON objects in the following format:

```json
{
    "error": 404,
    "message": "Resource not found"
}
```
The API will return three error types when requests fail:

- 404: Resource Not Found
- 400: Bad request 
- 405: Method not allowed

### Endpoints

#### GET /posts

- Fetches a list of posts from the database.
- Request Arguments: None
- Returns: A JSON object with a single key, data, that contains an array of posts.

`curl http://127.0.0.1:8000/posts`

```json
{
  "data": [
    {
      "id": 1,
      "title": "Brand new title",
      "content": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
      "created_at": "2022-10-26T15:31:19.000000Z",
      "updated_at": "2022-10-26T15:31:19.000000Z"
    }
  ]
}
```


#### GET /posts/{id}

- Get a specific post based on his id
- Return: A JSON object with a single key, data, that contains a specific post.
- Request Arguments: None

`curl http://127.0.0.1:8000/posts/1`

```json
{
  "data": {
    "id": 1,
    "title": "Brand new title",
    "content": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
    "created_at": "2022-10-26T15:31:19.000000Z",
    "updated_at": "2022-10-26T15:31:19.000000Z"
  }
}
```

#### POST /posts

- Create a brand new post
- Request Arguments: Required arguments are: 'title' and 'content'.
- Returns a success message and the id of the new post

`curl http://127.0.0.1:8000/posts -X POST -H "Content-Type: application/json" -d '{"title":"A new title", "content":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English."}'`

```json
{
    "message": "Resource created successfully.",
    "id": 2
}
```

#### PATCH /posts/{id}

- Update an existing post
- Request Arguments: Required arguments are: 'title' and 'content'.
- Returns a success message and the id of the updated post

`curl http://127.0.0.1:8000/posts/1 -X PATCH -H "Content-Type: application/json" -d '{"title":"A new title", "content":"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English."}'`

```json
{
    "message": "Resource updated successfully.",
    "id": 2
}
```

#### DELETE /posts/{id}

- Deletes a specific post based on his id
- Request arguments: None
- Returns a success message and the id of the deleted question

`curl -X DELETE http://127.0.0.1:8000/posts/2`

```json
{
    "message": "Resource deleted successfully",
    "id": 2
}
```


