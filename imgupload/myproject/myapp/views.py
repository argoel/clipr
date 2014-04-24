# -*- coding: utf-8 -*-
from django.shortcuts import render_to_response
from django.template import RequestContext
from django.http import HttpResponseRedirect,HttpResponse
from django.core.urlresolvers import reverse

from myproject.myapp.models import Document
from myproject.myapp.forms import DocumentForm


def list(request):
    # Handle file upload
    print "i am finally here"
    
    if request.method == 'POST':
        print 'request method is POST'
        f = request.FILES.get('imgurl')
        newdoc = Document(docfile = f)
        newdoc.save()
        print newdoc.docfile.url
        return HttpResponse(newdoc.docfile.url)
    else:
        form = DocumentForm() # A empty, unbound form

    # Load documents for the list page
    documents = Document.objects.all()

    # Render list page with the documents and the form
    return render_to_response(
        'myapp/list.html',
        {'documents': documents, 'form': form},
        context_instance=RequestContext(request)
    )
    
