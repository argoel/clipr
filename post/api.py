from post.models import *
from clipr.models import BackBoneCompatibleResource
from store.models import *

from mongoengine import *

from django.utils import simplejson
from django.http import HttpResponse

from tastypie import authorization
from tastypie.resources import *
from tastypie_mongoengine import fields

connect('clipr')

class PostResource(BackBoneCompatibleResource):
	store = fields.ReferenceField(to="store.api.StoreResource", attribute="store", full=True)
	class Meta:
		queryset = Post.objects.all()
		# print queryset
		resource_name = 'post'
		excludes = ['resource_uri', 'time_created', 'time_updated']
		allowed_methods = ('get', 'post', 'put', 'delete', 'patch', 'options')
		authorization = authorization.Authorization()