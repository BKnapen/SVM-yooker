<?php
    function get_wcproductcategories() {

        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';  
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );

        $all_categories = get_categories( $args );

        //print_r($all_categories);
    
        ob_start();
?>
    <section>
        <div class="gy-3 row">
            <div class="col-12">
                <h2>Maak een keuze uit een product categorie</h2>
            </div>
            <div class="col-12">
                <div class="row">
<?php
            foreach ($all_categories as $cat):
                if($cat->category_parent == 0):
                    $category_id = $cat->term_id;    
                    
                    // get the thumbnail id using the queried category term_id
                    $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );  
                    
                    // get the image URL
                    $image = wp_get_attachment_url( $thumbnail_id ); 
                    if($image):
?>
                        <div class="col-3">
                            <?php echo $cat->slug . ' - ' . $cat->name ?>
                            <img src="<?php echo $image ?>" alt="" />
                        </div>
<?php
                    endif;
    
                    $args2 = array(
                        'taxonomy'     => $taxonomy,
                        'child_of'     => 0,
                        'parent'       => $category_id,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                    );

                    $sub_cats = get_categories( $args2 );

                    if($sub_cats):
                        foreach($sub_cats as $sub_category):
                            $sub_category_id = $sub_category->term_id; 
                    
                            // get the thumbnail id using the queried category term_id
                            $sub_thumbnail_id = get_term_meta( $sub_category_id, 'thumbnail_id', true );  
                            
                            // get the image URL
                            $sub_image = wp_get_attachment_url( $sub_thumbnail_id ); 
                            if($sub_image):
?>
                                <div class="col-3">
                                    <div class="ratio ratio-4x3">
                                        <img class="mg-fluid object-fit-cover" src="<?php echo $sub_image ?>" alt="" />
                                    </div>
                                    <div class="bg-primary text-white text-center py-2">
                                        <?php echo $sub_category->name; ?>
                                    </div>
                                </div>
<?php
                            endif;
                        endforeach;
                    endif;
                endif;     
            endforeach;
?>
                </div>
            </div>
            <div class="col-12">
                <div class="g-1 row">
                <?php 
                    $colors = array(
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#DADADA', 
                            'bgcolor' => '#F8F8F8'
                        ),
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#F9C5AF', 
                            'bgcolor' => '#FEF3EF', 
                        ),
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#F4D7AD', 
                            'bgcolor' => '#FDF7EF', 
                        ),
                        array(
                            'spancolor' => '#FFFFFF',
                            'spanbgcolor' => '#000000', 
                            'bgcolor' => '#F8F8F8', 
                        ),
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#D7E9D9', 
                            'bgcolor' => '#F7FBF7', 
                        ),
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#FFF8AA',
                            'bgcolor' => '#FFFEEE', 
                        ),
                        array(
                            'spancolor' => '#000000',
                            'spanbgcolor' => '#BCE5FB',
                            'bgcolor' => '#F2FAFE', 
                        ),
                    );

                    $toepassingen = get_terms( array('taxonomy' => 'pa_toepassing', 'fields' => 'names' ) );
                    $j = 0;
                    foreach($toepassingen as $toepassing):
                        ?>
                        <div class="col">
                            <div class="d-flex align-items-center h-100" style="background-color:<?php echo $colors[$j]['bgcolor']; ?>">
                                <div class="d-flex align-items-center h-100 p-1 fs-smaller" style="color:<?php echo $colors[$j]['spancolor']; ?>; background-color:<?php echo $colors[$j]['spanbgcolor']; ?>"><?php echo $toepassing[0]; ?></div>
                                <div class="d-flex align-items-center p-1 fs-smaller"><?php echo $toepassing; ?></div>
                            </div>
                        </div>
                        <?php
                        $j++;
                    endforeach;
                ?>
                </div>
            </div>
            <div class="col-4">
<?php
            $args = array(
                //'category'  => array( 'category_slug' )
                // or 'term_taxonomy_id' => 4 i.e. category ID
            );


            //$wcattributtes = array();

            /*foreach( wc_get_products($args) as $product ):
                foreach( $product->get_attributes() as $attr_name => $attr ):
                    if(!in_array( wc_attribute_label($attr_name), $wcattributtes ) ):
                        array_push($wcattributtes, wc_attribute_label($attr_name));
                    endif;
                ?>

                    <!--<p><?php echo wc_attribute_label( $attr_name ); ?></p>-->
                <?php
                    foreach( $attr->get_terms() as $term ):
                ?>
                        <!--<p style="margin-bottom:0px"><?php echo $term->name; ?> </p>-->
                <?php
                    endforeach;
                endforeach;
            endforeach;
            
            foreach($wcattributtes as $attrb):
                ?>
                    <!--<p><b><?php echo wc_attribute_label( $attrb ); ?><b></p>-->
                <?php
            endforeach;*/

            //$attributes_tax_slugs = array_keys( wc_get_attribute_taxonomy_labels() );
            //print_r($attributes_tax_slugs);

             // Get an array of product attribute taxonomies names (starting with "pa_")
            //$attributes_tax_names = array_filter( array_map( 'wc_attribute_taxonomy_name', 'pa_toepassing'));

            $i = 0;
            ?>
                <div class="accordion" id="accordionExample">
                <?php
                    foreach(wc_get_attribute_taxonomies() as $values):
                        if($values->attribute_name != 'toepassing'):
                        $term_names = get_terms( array('taxonomy' => 'pa_' . $values->attribute_name, 'fields' => 'names' ) );
                ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                    <?php echo $values->attribute_label; ?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body"> 
                                    <?php foreach($term_names as $termname): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <?php echo $termname; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php //echo implode(', ', $term_names); ?>
                                </div>
                            </div>
                        </div>
                <?php
                        $i++;
                        endif;
                    endforeach;
                ?>
                </div>
            </div>
            <div class="col-8">
                <?php
                    $args = array(
                        //'category' => array( '' ),
                        'orderby'  => 'name',
                    );

                    $products = wc_get_products( $args );
                    foreach($products as $product):
                        #name
                        #sku
                        #regular_price
                        #sale_price
                        #Geschikt voor
                        ?>
                            <div class="row">
                                <div class="col">
                                </div>    
                                <div class="col">
                                    <h5><?php echo $product->name ?></h5>
                                    <p>Artikelnummer: <?php echo $product->sku ?></p>
                                    <p><?php echo $product->regular_price ?></p>
                                    <p><?php echo $product->sale_price ?></p>
                                </div> 
                            </div>
                        <?php
                    endforeach;
                ?>
            </div>
        </div>
    </section>
<?php
        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

    add_shortcode('wcproductcategories', 'get_wcproductcategories');

?>