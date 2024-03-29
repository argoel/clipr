from mongoengine import *
from djangotoolbox.fields import ListField, EmbeddedModelField
import datetime
from user.models import *
from post.models import *

class Likes(Document):
	def __unicode__(self):
		return self.post.title

	post = ReferenceField(Post)
	user = ReferenceField(User)
	time_created = DateTimeField(default=datetime.datetime.now)
	time_updated = DateTimeField(default=datetime.datetime.now)