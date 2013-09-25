class DBproducts 
	def initialize (dbVfsFiles = false, objectImages = nil)
		@db_vfs_files_driver 	= dbVfsFiles  
		@db_objectImages_driver = objectImages
		@productId 				= 3
		@separator				= "__"
		#@categoryId = category_id
		@data = []
		@sql_query = "INSERT INTO `products` (`productId`, `title`, `alias`, `categoryId`, `foreword`, `content`, `orderNumber`, `isAvailable`, `isVersions`, `price`, `smallImageId`, `bigImageId`, `versions`, `relationProductIds`, `statusId`) VALUES "
	end

	def set_category_id(category_id)
		@categoryId = category_id
	end

	def set_prefix(prefix = nil)
		@prefix = prefix ? prefix : "" 
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

			begin
				self.add_extra_images product
			rescue Exception => e
				
			end


		product_price = 0
		begin
			product_price = product.price.split(',').first.delete('^0-9')
		rescue Exception => e
			puts "\n ERROR price \n"
			puts product.title 
		end

		entry = "(#{@productId}, '#{product.title}', '#{@prefix.to_s + @separator.to_s + product.link.split("/").last.to_s}', #{@categoryId}, '#{product.description}', '#{product.full_text}', NULL, 1,0, #{product_price}, #{smallImage_id}, #{bigImage_id}, '[]', 'null', 1)\n"
		#puts "\n#{@prefix.to_s + @separator.to_s + product.link.split("/").last.to_s}" 

		@data.push @sql_query + entry
		
		@last_inserted_id = @productId
		@productId += 1 

	end

	def query
		#@data.join(",").prepend(@sql_query) << ";" 
		@data.join(";") << ";" 
	end

	def save_to_file(file_name)
		file = File.new(file_name, "a")
		file.puts(self.query)
		file.close
	end

	def add_extra_images product 
		# Remove first set of images already registred 
		product.images.shift 

		unless product.images.empty? 

			product.images.each do |entry| 

				record = {
					"big_image" 	=> @db_vfs_files_driver.insert(entry['big_image']), 
					"small_image" 	=> @db_vfs_files_driver.insert(entry['small_image']), 
					"objectId" 		=> @productId,
					"objectClass"	=> 'Product'
				}
				
				@db_objectImages_driver.insert record 
			end
		end	
	end

end