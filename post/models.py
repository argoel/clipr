from mongoengine import *
from djangotoolbox.fields import ListField, EmbeddedModelField
import datetime
from store.models import *

class Post(Document):
	'''
	Class for Posts/Clips made by retailers on ClipR
	'''
	def __unicode__(self):
		return self.title
	store = ReferenceField(Store)
	imgurl = StringField()
	title = StringField()
	desc = StringField()
	validity = StringField()
	cost = FloatField()
	clipcount = IntField(default=0)
	likecount = IntField(default=0)
	time_created = DateTimeField(default=datetime.datetime.now)
	time_updated = DateTimeField(default=datetime.datetime.now)

