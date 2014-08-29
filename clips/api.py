from post.models import *
from clipr.models import BackBoneCompatibleResource
from user.models import *
from clips.models import *

from mongoengine import *

from django.utils import simplejson
from django.http import HttpResponse

from tastypie import authorization
from tastypie.resources import *
from tastypie_mongoengine import fields
from tastypie.serializers import Serializer

connect('clipr')

class ClipsResource(BackBoneCompatibleResource):
	post = fields.ReferenceField(to="post.api.PostResource", attribute="post", full=True)
	user = fields.ReferenceField(to="user.api.UserResource", attribute="user", full=True)
	class Meta:
		queryset = Clips.objects.all().order_by("-time_updated")
		# print queryset
		resource_name = 'clips'
		filtering = {
            'post': ALL_WITH_RELATIONS,
            'user': ALL_WITH_RELATIONS,
        }
		excludes = ['resource_uri', 'time_created', 'time_updated']
		allowed_methods = ('get', 'post', 'put', 'delete', 'patch', 'options')
		authorization = authorization.Authorization()
		serializer = Serializer()

	def alter_list_data_to_serialize(self, request, data):
	    if request.GET.get('count'):
	    	return {'count': data['meta']['total_count']}
	    if request.GET.get('post_only'):
	    	posts = []
	    	for clip in data['objects']:
	    		post =  clip.data['post']
	    		posts.append(post.data)
	    	return posts
	    return data['objects']