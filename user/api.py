from user.models import *
from clipr.models import BackBoneCompatibleResource

from mongoengine import *

from django.utils import simplejson
from django.http import HttpResponse

from tastypie import authorization
from tastypie.resources import *
from tastypie_mongoengine import fields

connect('clipr')

class UserResource(BackBoneCompatibleResource):
	class Meta:
		queryset = User.objects.all()
		# print queryset
		resource_name = 'users'
		excludes = ['resource_uri', 'time_created', 'time_updated']
		allowed_methods = ('get', 'post', 'put', 'delete', 'patch', 'options')
		authorization = authorization.Authorization()