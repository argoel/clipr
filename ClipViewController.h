//
//  ClipViewController.h
//  CollectionDemo
//
//  Created by Arpit on 5/28/14.
//  Copyright (c) 2014 Stanford. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "MyCollectionViewCell.h"


@interface ClipViewController : UICollectionViewController <UICollectionViewDataSource, UICollectionViewDelegate>
@property (strong, nonatomic) NSMutableArray *posts;
@property UIRefreshControl *refreshControl;
@property (strong, nonatomic) NSString *pullURL;

@end
