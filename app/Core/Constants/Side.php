<?php 

namespace App\Core\Constants;

class Side {
    const Home = 'home';

    const Away = 'away';

    public static function otherSide(string $side)
    {
        if ($side == Side::Home)
            return Side::Away;

        return Side::Home;
    }
}