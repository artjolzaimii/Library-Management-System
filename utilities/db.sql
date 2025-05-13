CREATE TABLE genres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) UNIQUE,
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    username VARCHAR(50),
    password TEXT,
    image_path VARCHAR(255),
    role VARCHAR(20)
);

CREATE TABLE book(
	book_id INT AUTO_INCREMENT PRIMARY KEY,
    isbn varchar(30),
    publication_year INT, 
    publisher VARCHAR(30),
    language varchar(30),
    nr_pages INT,
    description TEXT,
    format varchar(20),
    image_path VARCHAR(255)
);

CREATE TABLE author (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    bio TEXT,
    nationality VARCHAR(50),
    image_path varchar(255),
    birth_year YEAR,
    death_year YEAR
);

CREATE TABLE book_author (
    book_id INT,
    author_id INT,
    PRIMARY KEY (book_id, author_id),
    FOREIGN KEY (book_id) REFERENCES book(book_Id) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES author(author_id) ON DELETE CASCADE
);

CREATE TABLE book_genre(
	book_id INT ,
    genre_id INT , 
    PRIMARY KEY (book_id, genre_id),
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES book(book_id) ON DELETE CASCADE   
);

create table eBook(
	ebook_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    book_path varchar(255),
    FOREIGN KEY (book_id) REFERENCES book(book_id)
);

CREATE TABLE sale_book(
	sale_book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    inventory INT,
    price DECIMAL(10,2),
    FOREIGN KEY (book_id) REFERENCES book(book_id)
);

CREATE TABLE borrow_book(
	borrow_book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT,
    inventory INT,
    book_condition varchar(20),
    FOREIGN KEY (book_id) REFERENCES book(book_id)
)