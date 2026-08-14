<?php if (!function_exists('frameflow_configs')) {
    function frameflow_configs($value)
    {
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'frameflow'),
                    'value' => frameflow()->get_opt('primary_color', '#3F3A36')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'frameflow'),
                    'value' => frameflow()->get_opt('secondary_color', '#1F1D1B')
                ],
                'third'   => [
                    'title' => esc_html__('Third', 'frameflow'),
                    'value' => frameflow()->get_opt('third_color', '#565656')
                ],
                'four'   => [
                    'title' => esc_html__('Four', 'frameflow'),
                    'value' => frameflow()->get_opt('four_color', '#98CDEA')
                ],
                'five'   => [
                    'title' => esc_html__('Five', 'frameflow'),
                    'value' => frameflow()->get_opt('five_color', '#FFC29F')
                ],
                'six'   => [
                    'title' => esc_html__('Six', 'frameflow'),
                    'value' => frameflow()->get_opt('six_color', '#EFCCFF')
                ],
                'body_bg'   => [
                    'title' => esc_html__('Body Background Color', 'frameflow'),
                    'value' => frameflow()->get_opt('body_bg_color', '#fff')
                ]
            ],

            'link' => [
                'color' => frameflow()->get_opt('link_color', ['regular' => '#1A1A1A'])['regular'],
                'color-hover'   => frameflow()->get_opt('link_color', ['hover' => '#222'])['hover'],
                'color-active'  => frameflow()->get_opt('link_color', ['active' => '#222'])['active'],
            ],
            'gradient' => [
                'color-from' => frameflow()->get_opt('gradient_color', ['from' => '#A493FF'])['from'],
                'color-to' => frameflow()->get_opt('gradient_color', ['to' => '#72BEF9'])['to'],
            ],
            'gradient_two' => [
                'color-from' => frameflow()->get_opt('gradient_color_two', ['from' => '#8160C7'])['from'],
                'color-to' => frameflow()->get_opt('gradient_color_two', ['to' => '#503687'])['to'],
            ],
        ];
        return $configs[$value];
    }
}
if (!function_exists('frameflow_inline_styles')) {
    function frameflow_inline_styles()
    {

        $theme_colors      = frameflow_configs('theme_colors');
        $link_color        = frameflow_configs('link');
        $gradient_color        = frameflow_configs('gradient');
        $gradient_two_color    = frameflow_configs('gradient_two');
        $fonts = function_exists('frameflow_resolved_fonts')
            ? frameflow_resolved_fonts()
            : [
                'body' => '"Inter", sans-serif',
                'heading' => '"Instrument Serif", serif',
                'theme_default' => '"Schibsted Grotesk", sans-serif',
            ];
        ob_start();
        echo ':root{';

        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color: %2$s;', str_replace('#', '', $color),  $value['value']);
        }
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color-rgb: %2$s;', str_replace('#', '', $color),  frameflow_hex_rgb($value['value']));
        }
        foreach ($link_color as $color => $value) {
            printf('--link-%1$s: %2$s;', $color, $value);
        }
        foreach ($gradient_color as $color => $value) {
            printf('--gradient-%1$s: %2$s;', $color, $value);
        }
        foreach ($gradient_two_color as $color => $value) {
            printf('--gradient-two-%1$s: %2$s;', $color, $value);
        }

        printf('--body-font: %s;', $fonts['body']);
        printf('--primary-font: %s;', $fonts['heading']);
        printf('--heading-font: %s;', $fonts['heading']);
        printf('--theme-default-font: %s;', $fonts['theme_default']);

        echo '}';

        // Apply stacks with enough weight to beat hardcoded compiled CSS.
        echo 'body{font-family:var(--body-font);}';
        echo 'h1,h2,h3,h4,h5,h6,.ft-heading,.product_title.entry-title{font-family:var(--primary-font);}';
        echo '.ft-theme-default,.ft-secondary{font-family:var(--theme-default-font);}';

        return ob_get_clean();
    }
}
