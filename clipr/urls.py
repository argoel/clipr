from django.conf.urls import patterns, include, url
from tastypie.api import Api
from store.api import *
from post.api import *
from user.api import *
from clips.api import *
from likes.api import *

# Uncomment the next two lines to enable the admin:
# from django.contrib import admin
# admin.autodiscover()

v1_api = Api(api_name='v1')
v1_api.register(StoreResource())
v1_api.register(PostResource())
v1_api.register(UserResource())
v1_api.register(ClipsResource())
v1_api.register(LikesResource())

urlpatterns = patterns('',
    # Examples:
    # url(r'^api/get/customerinfo/$', 'customers.api.get_customerinfo'),
    # url(r'^api/get/customers/$', 'customers.api.get_customers'),

    # url(r'^api/get/stores/$', 'stores.api.get_stores'),

    # url(r'^api/get/cards/$', 'cards.api.get_cards'),

    # url(r'^customers/$', 'customers.views.customermanager'),

    url(r'^api/', include(v1_api.urls)),



    # url(r'^$', 'suloop.views.home', name='home'),
    # url(r'^suloop/', include('suloop.foo.urls')),

    # Uncomment the admin/doc line below to enable admin documentation:
    # url(r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
    # url(r'^admin/', include(admin.site.urls)),
)

