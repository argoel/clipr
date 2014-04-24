from mongoengine import *
from djangotoolbox.fields import ListField, EmbeddedModelField
import datetime
from store.models import *

class Post(Document):
	'''
	Class for Posts/Clips made by retailers on ClipR
	'''
	def __unicode__(self):
		return self.name

	store = ReferenceField(Store)
	imgurl = StringField()
	text_w_offer = StringField()
	time_created = DateTimeField(default=datetime.datetime.now)
	time_updated = DateTimeField(default=datetime.datetime.now)

