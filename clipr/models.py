from tastypie_mongoengine import resources

class BackBoneCompatibleResource(resources.MongoEngineResource):
	class Meta:
		always_return_data = True

	def alter_list_data_to_serialize(self, request, data):
		return data["objects"]