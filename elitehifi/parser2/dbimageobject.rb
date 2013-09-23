class DBobjectImages 

	def initialize 
		@objectImageId 	= 1 
		@data 			= []

		@sql_query = "INSERT INTO objectImages (objectImageId, objectClass, objectId, title, orderNumber, smallImageId, bigImageId, statusId) VALUES "
	end



	def insert record 

		sql_query = "\n(#{@objectImageId}, #{record['objectClass']}, #{record['objectId']}, 'title', 1, #{record['small_image']}, #{record['big_image']}, 1)"

		@data.push sql_query 

		puts "\n\n DEBUG \n\n"
		puts "\n\n #{@data}\n\n"

		@last_inserted_id, @objectImageId = @objectImageId, @objectImageId + 1 
	
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