CREATE TABLE genres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role varchar(20)  NOT NULL,
    gender varchar(20) NOT NULL,
    birthday DATE,
    image_path VARCHAR(255)
);

CREATE TABLE book(
	book_id INT AUTO_INCREMENT PRIMARY KEY,
	title varchar(127) NOT NULL,
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
    birth_year INT,
    death_year INT
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
CREATE TABLE shopping_cart(
	cart_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cart_book(
	item_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    book_id INT NOT NULL ,
    quantity INT DEFAULT 1,
    
    FOREIGN KEY (cart_id) REFERENCES shopping_cart(cart_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES book(book_id) ON DELETE CASCADE
 );
 
 CREATE TABLE orders(
	order_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(127) NOT NULL,
    last_name VARCHAR(127) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(127) NOT NULL,
    country VARCHAR(127) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(127) NOT NULL,
    notes VARCHAR(511),
    cart_id INT,
    status varchar(50) default 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES shopping_cart(cart_id)
);

CREATE TABLE order_book(
	order_id INT NOT NULL,
    book_id INT NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY(order_id,book_id),
    FOREIGN KEY (book_id) REFERENCES book(book_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

CREATE TABLE order_billing_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    order_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE review (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_review_book FOREIGN KEY (book_id) REFERENCES book(book_id) ON DELETE CASCADE,
    CONSTRAINT fk_review_user FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    notified TINYINT(1) NOT NULL DEFAULT 0;
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES book(book_id) ON DELETE CASCADE
);

CREATE TABLE sales_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_books_sold INT NOT NULL,
    most_sold_book VARCHAR(255) NOT NULL,
    total_revenue DECIMAL(10,2) NOT NULL,
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL
);


CREATE TABLE borrowed_books (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    book_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE,
    status ENUM('Borrowed', 'Returned', 'Overdue') DEFAULT 'Borrowed',
    FOREIGN KEY (book_id) REFERENCES book(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);