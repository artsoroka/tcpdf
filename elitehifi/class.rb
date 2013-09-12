class WellDone
	include SERIALIZE
end



class Something
	def initialize()
		@t1 = 10
		@t2 = 20
	end

	include SERIALIZE
end 

s = Something.new 

puts s.to_json

x = WellDone.new
puts x.to_json 