1. Model
- Tạo model: 
	php artisan make:mode ModelName
	php artisan make:mode FolderName/ModelName

- Create dữ liệu với Model

	ModelName::create(array)
	->  [
			'column_name' => 'Value'
		]

		User:

		[
			'name'  => 'Nguyen Van A',
			'email' => 'aaa@gmail.com'
		]

		Insert into table('column', 'column') values('', '');

- fillable
- set/getAttribute

* Relation model


* Seeder
- Tạo: php artisan make:seeder UserTableSeeder
- Chạy: php artisan db:seed

* Relation (ORM)
			Questions    -   Answer 
	   		   1  			     N
In model:	hasMany         belongsTo

			Exam				   Question
			 N 					      N
In model:	belongsToMany         belongsToMany


* Query Builder
- Những bạn thi nhiều nhất
- Đề thi có nhiều người thi nhất
- Những bạn thi kết quả cao nhất
- Những bạn thi nhiều nhất theo khoảng thời gian
- Top danh sách thi nhiều theo tuần, theo tháng

Data Sample
- 1000 đề thi
- Ngân hàng câu hỏi là 1000.000
-> 4000.000 câu trả lời
- User: 500
- Tham gia thi: tùy các bạn không dưới 5000


* Factory
- Data Sample: $faker
- User
- Question
	Answers
- Exams
- Assign Question -> Exam
- Results