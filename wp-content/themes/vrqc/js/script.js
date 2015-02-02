app = angular.module('vrqc', []);
/*app.run(function($rootScope){
    console.log('BlogInfo',BlogInfo);
    $rootScope.dir = BlogInfo.url;
    $rootScope.site = BlogInfo.site;
    $rootScope.api = AppAPI.url;
    console.log(BlogInfo.site);
    console.log(AppAPI.url);
});*/
app.controller('vrqcCtrl', function($scope, $http, $rootScope, $timeout){
    $scope.postData = [];
    $scope.test = true;
    $timeout(function(){
        angular.forEach($rootScope.propertyArray, function (url, index) {
            console.log('url', url);
            console.log('index', index);
            $http({
                method: 'GET',
                url: url + '?json=1',
                params: {
                    json: 'get_posts'
                }
            }).success(function (data, status, headers, config) {
                (function () {
                    $scope.postData.push(data.posts[0]);
                })();
            }).error(function (data, status, headers, config) {
            });

        });
    }, 0)
})
.controller('vrqcPropCtrl', function($scope, $http, $rootScope, $timeout){
        $scope.vrqc = {};
        $scope.vrqc.propertiesData = {};
        $scope.vrqc.postsData = {};
        $scope.vrqc.offersData = {};
        $scope.vrqc.weather = {};
        $timeout(function(){
            /*$http({
                method: 'GET',
                url: 'http://localhost/vrqc/',
                params: {
                    json: 'get_posts'

                }
            }).success(function (data, status, headers, config) {
                console.log(data);
                $scope.postsData=data;
            }).error(function (data, status, headers, config) {
            });*/
            $http.get('http://localhost/vrqc/api/get_posts/?post_type=easy-rooms')
                .success(function (data, status, headers, config) {
                    console.log('propertiesData',data);
                    $scope.vrqc.propertiesData = data;
                    angular.forEach($scope.vrqc.propertiesData.posts, function(property){
                        $http.get('http://localhost/vrqc/api/get_post/?slug='+property.slug).success(function(data){
                            $scope.slug = data.status;
                            if( $scope.slug === 'error' ) {
                                $http.get('http://localhost/vrqc/?json=create_post&nonce=836a4c0360&title=' + property.title + '&categories=properties&status=publish&custom[name]=herryo&custom[age]=retro')
                                    .success(function (data, status, headers, config) {
                                        console.log('newpost', data);
                                    }).error(function (data, status, headers, config) {
                                        console.log('newpost', 'sucks');
                                    });
                            }
                        });
                    })
                }).error(function (data, status, headers, config) {
                    console.log('sucks');
            });
            $http.get('http://localhost/vrqc/?json=get_posts&cat=-5,-2,-7')
                .success(function (data, status, headers, config) {
                    console.log('postsData',data);
                    $scope.vrqc.postsData = data;
                }).error(function (data, status, headers, config) {
                    console.log('sucks');
            });
            $http.get('http://localhost/vrqc/?json=get_posts&cat=5')
                .success(function (data, status, headers, config) {
                    console.log('OffersData',data);
                    $scope.vrqc.offersData = data;
                }).error(function (data, status, headers, config) {
                    console.log('sucks');
            });
            $http.get('http://localhost/vrqc/?json=get_posts&cat=7')
                .success(function (data, status, headers, config) {
                    console.log('propertyPosts',data);
                    $scope.vrqc.propertyPosts = data;
                }).error(function (data, status, headers, config) {
                    console.log('sucks');
            });
            $http.get('http://api.wunderground.com/api/d26d4a3f9b087f03/geolookup/conditions/q/Canada/Québec.json')
                .success(function (data, status, headers, config) {
                    console.log('weather',data);
                    $scope.vrqc.weather = data.current_observation;
                }).error(function (data, status, headers, config) {
                    console.log('sucks');
            });
        },0)
});