//
//  DetailViewController.m
//  CollectionDemo
//
//  Created by Arpit on 5/15/14.
//  Copyright (c) 2014 Stanford. All rights reserved.
//

#import "DetailViewController.h"

@interface DetailViewController ()
@end

@implementation DetailViewController

- (IBAction)clipped:(id)sender {
    _clipLabel.text = @"I am clipped";
}
- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
    if (_detailPost) {
        _titleLabel.text = _detailPost.title;
        _storeLabel.text = _detailPost.storeName;
        _imageView.image = _detailPost.image;
        _distanceLabel.text = @"3 mi";
    }
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
