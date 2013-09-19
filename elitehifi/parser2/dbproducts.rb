class DBproducts 
	def initialize (dbVfsFiles = false)
		@db_vfs_files_driver = dbVfsFiles  
		@productId = 3
		#@categoryId = category_id
		@data = []
		@sql_query = "INSERT INTO `products` (`productId`, `title`, `alias`, `categoryId`, `foreword`, `content`, `orderNumber`, `isAvailable`, `isVersions`, `price`, `smallImageId`, `bigImageId`, `versions`, `relationProductIds`, `statusId`) VALUES "
	end

	def set_category_id(category_id)
		@categoryId = category_id
	end

	def insert product 
		# product object
		smallImage_id = 'NULL'
		bigImage_id	= 'NULL'

			begin
				smallImage_id = @db_vfs_files_driver.insert(product.images.first['small_image'])
				bigImage_id	= @db_vfs_files_driver.insert(product.images.first['big_image'])
			rescue Exception => e
				puts "Error images #{product.title}" 				
			end


		product_price = 0
		begin
			product_price = product.price.split(',').first.delete('^0-9')
		rescue Exception => e
			puts "\n ERROR price \n"
			puts product.title 
		end

		entry = "\n (#{@productId}, '#{product.title}', '#{product.link.split("/").last}', #{@categoryId}, '#{product.description}', '#{product.full_text}', NULL, 1,0, #{product_price}, #{smallImage_id}, #{bigImage_id}, '[]', 'null', 1)"
		#puts "\n \n #{product.price} \n"
		@data.push entry
		
		@last_inserted_id = @productId
		@productId += 1 

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