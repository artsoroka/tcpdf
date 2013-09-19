class DBcategories 
	def initialize ()
		@categoryId = 5
		@data = []
		@sql_query = "INSERT INTO  `categories` (`categoryId`, `title`, `alias`, `foreword`, `content`, `orderNumber`, `parentCategoryId`, `statusId`) VALUES "
	end

	def insert category 
		entry = "\n(#{@categoryId}, '#{category.text}', '#{category.link.split('/').last}', 'foreword', '', NULL, NULL, 1) "
		@data.push entry 
		@last_inserted_id, @categoryId = @categoryId, @categoryId + 1

		@last_inserted_id 

	end

	def query
		@data.join(",").prepend(@sql_query) << ";" 
	end

	def save_to_file(file_name)
		file = File.new(file_name, "a")
		file.puts(self.query)
		file.close
	end



end