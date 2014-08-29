//
//  MyCollectionViewController.h
//  CollectionDemo
//
//  Created by Arpit on 5/12/14.
//  Copyright (c) 2014 Stanford. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "MyCollectionViewCell.h"


@interface MyCollectionViewController : UICollectionViewController <UICollectionViewDataSource, UICollectionViewDelegate>
@property (strong, nonatomic) NSMutableArray *posts;
@property UIRefreshControl *refreshControl;
@property (strong, nonatomic) NSString *pullURL;
@end
