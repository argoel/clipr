//
//  ClipViewController.m
//  CollectionDemo
//
//  Created by Arpit on 5/28/14.
//  Copyright (c) 2014 Stanford. All rights reserved.
//

#import "ClipViewController.h"
#import "Post.h"
#import <QuartzCore/QuartzCore.h>
#import "DetailViewController.h"

@interface ClipViewController ()

@end

@implementation ClipViewController

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
    UIView *whiteView = [[UIView alloc]init];
    whiteView.backgroundColor = [UIColor colorWithRed:0.953 green:0.933 blue:0.933 alpha:1];
    self.collectionView.backgroundView = whiteView;
    
    _refreshControl = [[UIRefreshControl alloc] init];
    _refreshControl.tintColor = [UIColor grayColor];
    [self.collectionView addSubview:_refreshControl];
    [_refreshControl addTarget:self action:@selector(refresh)
              forControlEvents:UIControlEventValueChanged];
    self.collectionView.alwaysBounceVertical = YES;
	// Do any additional setup after loading the view.
    [self loadPosts];
	// Do any additional setup after loading the view.
}

-(void)refresh {
    //do something to refresh
    NSLog(@"Refreshed");
    [self loadPosts];
    for (Post *post in _posts){
        NSLog(@"%@", post.title);
    }
    [_refreshControl endRefreshing];
    [self.collectionView reloadData];
}

-(void)loadPosts {
    NSString *postURL = @"http://localhost:8000/api/v1/clips?user=536bf0f18f01b7efe0389ad7&post_only=True";
    NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:postURL]];
    
    NSURLResponse *response = nil;
    NSError *error = nil;
    NSData *data = [NSURLConnection sendSynchronousRequest:request
                                         returningResponse:&response
                                                     error:&error];
        
    if (error == nil)
    {
        NSArray* postArray = [NSJSONSerialization
                              JSONObjectWithData:data //1
                              options:kNilOptions
                              error:&error];
        _posts = [[NSMutableArray alloc]init];
        for(NSDictionary *curpost in postArray){
            //            NSLog(@"%@", [post objectForKey:@"imgurl"]);
            Post *post = [[Post alloc] init];
            
            post.title = [curpost objectForKey:@"title"];
            
            NSString *postImageURL = [curpost objectForKey:@"imgurl"];
            
            NSURL *tempURL = [NSURL URLWithString:postImageURL];
            
            NSData *tempData = [NSData dataWithContentsOfURL:tempURL];
            
            post.image = [UIImage imageWithData:tempData];
            
            NSDictionary *store = [curpost objectForKey:@"store"];
            
            NSLog(@"%@", [store objectForKey:@"name"]);
            
            post.storeName = [store objectForKey:@"name"];
            
            [_posts addObject:post];
        }
        //        NSLog(@"%i",_postImageURLs.count);
    }
    
}


- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark -
#pragma mark UICollectionViewDataSource

-(NSInteger)numberOfSectionsInCollectionView:(UICollectionView *)collectionView {
    return 1;
}

- (NSInteger)collectionView:(UICollectionView *)collectionView numberOfItemsInSection:(NSInteger)section {
    //    NSLog(@"%i",_postImageURLs.count);
    return _posts.count;
    //    return _bugsImages.count;
}

- (UICollectionViewCell *)collectionView:(UICollectionView *)collectionView cellForItemAtIndexPath:(NSIndexPath *)indexPath {
    MyCollectionViewCell *myCell = [collectionView
                                    dequeueReusableCellWithReuseIdentifier:@"MyCell" forIndexPath:indexPath];
    long row = [indexPath row];
    
    Post *post = [[Post alloc] init];
    
    post = _posts[row];
    
    myCell.imageView.image = post.image;
    myCell.titleLabel.text = post.title;
    myCell.storeLabel.text = post.storeName;
    //    [myCell.layer setBorderColor:[UIColor blackColor].CGColor];
    //    [myCell.layer setBorderWidth:1.0f];
    myCell.contentView.backgroundColor = [UIColor whiteColor];
    return myCell;
    
}

-(void)collectionView:(UICollectionView *)collectionView didDeselectItemAtIndexPath:(NSIndexPath *)indexPath {
    long row = [indexPath row];
    
    Post *post = [[Post alloc] init];
    
    post = _posts[row];
    
    NSLog(@"sequeing");
    DetailViewController *detailViewController = [[DetailViewController alloc]init];
    detailViewController.detailPost = post;
    [self.navigationController pushViewController:detailViewController animated: YES];
}

- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender{
    if ([[segue identifier]isEqualToString:@"ClipDetail"]){
        NSIndexPath *selectedIndexPath = [[self.collectionView indexPathsForSelectedItems]objectAtIndex:0];
        NSLog(@"%d",selectedIndexPath.item);
        
        DetailViewController *detailView = [segue destinationViewController];
        long row = [selectedIndexPath row];
        
        Post *post = [[Post alloc] init];
        
        post = _posts[row];
        
        [detailView setDetailPost:post];
    }
}


@end
