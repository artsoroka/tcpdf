require 'open-uri'
require 'fastimage'
require 'json' 

class DBvfsFiles

	def initialize 
		@last_inserted_id
		@fileId = 1
		@folderId = 2
		@folder_path = '201309' 
		@data = []
		@query = "INSERT INTO `vfsFiles` (`fileId`, `folderId`, `title`, `path`, `params`, `isFavorite`, `mimeType`, `fileSize`, `fileExists`, `statusId`, `createdAt`) VALUES "

	end

	def insert(image)

		self.get_remote_image image

		params = self.image_size 
		mime_type = self.mime_type 
		
		entry = "\n(#{@fileId}, #{@folderId}, '#{@file_title}', '#{@path}', '#{params}', NULL, '#{mime_type}', #{@file_size}, 1, 1, #{Time.now.to_s.split(' +').first})"
		
		@data.push entry
		@last_inserted_id = @fileId
		@fileId += 1 
		@data.length
	end

	def last_inserted_id
		@last_inserted_id
	end 

	def query()
		@data.join(",").prepend(@query) << ";" unless @data.empty?  
	end

	def save_to_file(file_name)
		file = File.new(file_name, "a")
		file.puts(self.query)
		file.close
	end

	protected

	def get_remote_image(image_url)

		file_extension 	= image_url.split('/').last.split('.').last
		@file_title		= image_url.split('/').last.split('.').first 

		file_name = @folderId.to_s + "_" + @fileId.to_s + "." + file_extension 

		@path = @folder_path + "/" + file_name 

		@file = File.new(@path, 'a')
		@file << open( image_url.prepend('http://elitehifi.spb.ru') ).read 
		@file_size = @file.size 
		@file.close 

	end

	def image_size
		w, h = FastImage.size(@file.path)
		{"width" => w, "height" => h}.to_json
	end

	def mime_type
		"image/" + FastImage.type(@file.path).to_s	
	end


end

# USAGE 

# vfsFiles = DBvfsFiles.new 
# puts vfsFiles.insert('/images/cms/data/catalog/products/Clearaudio_SmartMatrix.jpg')
# vfsFiles.save_to_file('vfs.sql')
