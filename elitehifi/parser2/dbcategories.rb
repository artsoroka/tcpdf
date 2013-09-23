class DBcategories 
	def initialize ()
		@categoryId = 5
		@data = []
		@sql_query = "INSERT INTO  `categories` (`categoryId`, `title`, `alias`, `foreword`, `content`, `orderNumber`, `parentCategoryId`, `statusId`) VALUES "
	end

	#def insert(category, parent_category = 'NULL') 
	# MONDAY 
	def insert(category, parent_category = nil) 
		
		if parent_category
			category_name = parent_category.link.split('/').last.to_s + "__" + category.link.split('/').last
		else 
			category_name = category.link.split('/').last.to_s
		end

		entry = "\n(#{@categoryId}, '#{category.text}', '#{category_name}', 'foreword', '', NULL, NULL, 1) "
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