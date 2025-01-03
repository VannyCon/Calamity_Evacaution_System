<?php
//THIS PART RETURN JSON WHICH THE JSON USE TO MAP THE COVERAGE OF SAGAY CITY

header('Content-Type: application/json');

echo json_encode([
    "type" => "FeatureCollection",
    "features" => [
        [
            "type" => "Feature", // Corrected from ":" to "=>"
            "properties" => [], // Using an empty array for properties
            "geometry" => [
                "type" => "Polygon", // or "MultiPolygon" depending on your data
                "coordinates" => [
                    [
                      [
                        123.25853795993885,
                        10.659911800879627
                      ],
                      [
                        123.26868210931573,
                        10.68759834106475
                      ],
                      [
                        123.27963583736584,
                        10.71051142566294
                      ],
                      [
                        123.28514472865155,
                        10.721768856393714
                      ],
                      [
                        123.28981102029623,
                        10.733099520028276
                      ],
                      [
                        123.301385746363,
                        10.761760957162814
                      ],
                      [
                        123.30716406174605,
                        10.776138220680725
                      ],
                      [
                        123.31001205849071,
                        10.78308401755846
                      ],
                      [
                        123.31308528063556,
                        10.789959698791534
                      ],
                      [
                        123.31942191337586,
                        10.803896751706581
                      ],
                      [
                        123.32554443019846,
                        10.81761177548735
                      ],
                      [
                        123.32861599251837,
                        10.824270930921976
                      ],
                      [
                        123.33147950623203,
                        10.825373715308485
                      ],
                      [
                        123.33269489206526,
                        10.825940329291033
                      ],
                      [
                        123.33277715482167,
                        10.82667514334518
                      ],
                      [
                        123.332205807556,
                        10.827057228959742
                      ],
                      [
                        123.33228384594833,
                        10.827824104589691
                      ],
                      [
                        123.33346705657709,
                        10.828199898864352
                      ],
                      [
                        123.33416756943117,
                        10.829026927071313
                      ],
                      [
                        123.33456465857626,
                        10.829927486418647
                      ],
                      [
                        123.33594816055515,
                        10.831343582709628
                      ],
                      [
                        123.33714915739716,
                        10.8318187478042
                      ],
                      [
                        123.33843600568729,
                        10.831940041520916
                      ],
                      [
                        123.34087452920326,
                        10.8328889128151
                      ],
                      [
                        123.3411123907334,
                        10.833439135455487
                      ],
                      [
                        123.34071304392312,
                        10.834198464459156
                      ],
                      [
                        123.34055896701972,
                        10.834594076653088
                      ],
                      [
                        123.3404642338291,
                        10.835069857014435
                      ],
                      [
                        123.34041300885197,
                        10.836881935987531
                      ],
                      [
                        123.34040686798181,
                        10.837224396586903
                      ],
                      [
                        123.34030015888317,
                        10.837561212765053
                      ],
                      [
                        123.33986524455693,
                        10.837898140456948
                      ],
                      [
                        123.3398224022038,
                        10.838250081500178
                      ],
                      [
                        123.34030442608068,
                        10.83870419321072
                      ],
                      [
                        123.34102674087227,
                        10.83894781615107
                      ],
                      [
                        123.34114482431914,
                        10.839525645102977
                      ],
                      [
                        123.34051541211798,
                        10.840287889938939
                      ],
                      [
                        123.34040739963312,
                        10.840667307592746
                      ],
                      [
                        123.34084349701146,
                        10.841086133542957
                      ],
                      [
                        123.3411234331949,
                        10.841941028750263
                      ],
                      [
                        123.34142465372724,
                        10.84223607571451
                      ],
                      [
                        123.34219305299239,
                        10.84350518701585
                      ],
                      [
                        123.34125153897153,
                        10.844222997543028
                      ],
                      [
                        123.3421047966871,
                        10.84450873273178
                      ],
                      [
                        123.34321625928922,
                        10.844197542823562
                      ],
                      [
                        123.34482564530903,
                        10.84470085250228
                      ],
                      [
                        123.34786715534506,
                        10.845748389069602
                      ],
                      [
                        123.34758453789007,
                        10.847828630045392
                      ],
                      [
                        123.34373347626102,
                        10.850618128577791
                      ],
                      [
                        123.34097361009947,
                        10.858169616323845
                      ],
                      [
                        123.33957598822258,
                        10.862745643802272
                      ],
                      [
                        123.34088812978882,
                        10.867914449450772
                      ],
                      [
                        123.342436051481,
                        10.869538148763453
                      ],
                      [
                        123.34296012207268,
                        10.873100284001941
                      ],
                      [
                        123.34619866030039,
                        10.879515924758142
                      ],
                      [
                        123.34747532166134,
                        10.886326162424979
                      ],
                      [
                        123.34744206968828,
                        10.893166134292938
                      ],
                      [
                        123.35000402678037,
                        10.901573984766255
                      ],
                      [
                        123.35391666617453,
                        10.910803249943307
                      ],
                      [
                        123.35558060110367,
                        10.915022989495304
                      ],
                      [
                        123.36070526314884,
                        10.918381772756153
                      ],
                      [
                        123.37273504418899,
                        10.932832716138345
                      ],
                      [
                        123.37024056544908,
                        10.936931537420055
                      ],
                      [
                        123.370798336131,
                        10.941969979070574
                      ],
                      [
                        123.37112425722911,
                        10.949185712554373
                      ],
                      [
                        123.37379060157446,
                        10.950707193480383
                      ],
                      [
                        123.37436584609412,
                        10.961983801711828
                      ],
                      [
                        123.37191961318787,
                        10.985523962578974
                      ],
                      [
                        123.36519287595382,
                        11.039365141854164
                      ],
                      [
                        123.36074596124668,
                        11.084280577613185
                      ],
                      [
                        123.3940583839736,
                        11.093028633321278
                      ],
                      [
                        123.42222740738313,
                        11.10329306513652
                      ],
                      [
                        123.44689460301147,
                        11.103755657389916
                      ],
                      [
                        123.46473476388707,
                        11.115464999184468
                      ],
                      [
                        123.52373048866991,
                        11.052672299983634
                      ],
                      [
                        123.55473815674347,
                        11.018656777253437
                      ],
                      [
                        123.57519549447551,
                        11.005088959579524
                      ],
                      [
                        123.73454356664304,
                        10.96070532368519
                      ],
                      [
                        123.7301978675512,
                        10.911730437619596
                      ],
                      [
                        123.71183678148142,
                        10.869852127517134
                      ],
                      [
                        123.67190589881741,
                        10.881358975290645
                      ],
                      [
                        123.6295200662971,
                        10.894165131826668
                      ],
                      [
                        123.54765908070874,
                        10.918968900841163
                      ],
                      [
                        123.52539878033544,
                        10.882431835847736
                      ],
                      [
                        123.49150252412542,
                        10.869551109570555
                      ],
                      [
                        123.48122364724094,
                        10.865196119054573
                      ],
                      [
                        123.47902798371294,
                        10.863776192755262
                      ],
                      [
                        123.46674099527795,
                        10.862593885260914
                      ],
                      [
                        123.41839234486507,
                        10.81395710256405
                      ],
                      [
                        123.36914302680395,
                        10.765600680622669
                      ],
                      [
                        123.34244317214376,
                        10.739247272569482
                      ],
                      [
                        123.31478238705381,
                        10.712219389913493
                      ],
                      [
                        123.25853795993885,
                        10.659911800879627
                      ] // Closing the polygon
                    ]
                ]
            ]
        ]
    ]
]);
?>
