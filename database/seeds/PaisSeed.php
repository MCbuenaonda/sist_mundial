<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pais')->insert(['nombre' => 'Afganistán', 'siglas' => 'AFG', 'iso' => 'AF', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 33,'lng' => 65 ,'federacion' => 'FEDERACIÓN AFGANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Albania', 'siglas' => 'ALB', 'iso' => 'AL', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 41,'lng' => 20 ,'federacion' => 'FEDERACIÓN ALBANESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Alemania', 'siglas' => 'GER', 'iso' => 'DE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 51,'lng' => 9 ,'federacion' => 'FEDERACIÓN ALEMANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Andorra', 'siglas' => 'AND', 'iso' => 'AD', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 42.5,'lng' => 1.5 ,'federacion' => 'FEDERACIÓN ANDORRANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Angola', 'siglas' => 'ANG', 'iso' => 'AO', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -12.5,'lng' => 18.5 ,'federacion' => 'FEDERACIÓN ANGOLEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Anguila', 'siglas' => 'AIA', 'iso' => 'AI', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 18.25,'lng' => -63.16666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ANGUILA']);
        DB::table('pais')->insert(['nombre' => 'Antigua y Barbuda', 'siglas' => 'ATG', 'iso' => 'AG', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 17.05,'lng' => -61.8 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ANTIGUA Y BARBUDA']);
        DB::table('pais')->insert(['nombre' => 'Arabia Saudita', 'siglas' => 'KSA', 'iso' => 'SA', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 25,'lng' => 45 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ARABIA SAUDITA']);
        DB::table('pais')->insert(['nombre' => 'Argelia', 'siglas' => 'ALG', 'iso' => 'DZ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 28,'lng' => 3 ,'federacion' => 'FEDERACIÓN ARGELINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Argentina', 'siglas' => 'ARG', 'iso' => 'AR', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -34,'lng' => -64 ,'federacion' => 'ASOCIACIÓN DEL FÚTBOL ARGENTINO']);
        DB::table('pais')->insert(['nombre' => 'Armenia', 'siglas' => 'ARM', 'iso' => 'AM', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 40,'lng' => 45 ,'federacion' => 'FEDERACIÓN ARMENIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Aruba', 'siglas' => 'ARU', 'iso' => 'AW', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 12.5,'lng' => -69.96666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ARUBA']);
        DB::table('pais')->insert(['nombre' => 'Australia', 'siglas' => 'AUS', 'iso' => 'AU', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => -27,'lng' => 133 ,'federacion' => 'FEDERACIÓN AUSTRALIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Austria', 'siglas' => 'AUT', 'iso' => 'AT', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 47.33333333,'lng' => 13.33333333 ,'federacion' => 'FEDERACIÓN AUSTRIACA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Azerbaiyán', 'siglas' => 'AZE', 'iso' => 'AZ', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 40.5,'lng' => 47.5 ,'federacion' => 'FEDERACIÓN AZERBAIYANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Bahamas', 'siglas' => 'BAH', 'iso' => 'BS', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 24.25,'lng' => -76 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BAHAMAS']);
        DB::table('pais')->insert(['nombre' => 'Bahréin', 'siglas' => 'BHR', 'iso' => 'BH', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 26,'lng' => 50.55 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BARÉIN']);
        DB::table('pais')->insert(['nombre' => 'Bangladesh', 'siglas' => 'BAN', 'iso' => 'BD', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 24,'lng' => 90 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BANGLADÉS']);
        DB::table('pais')->insert(['nombre' => 'Barbados', 'siglas' => 'BRB', 'iso' => 'BB', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 13.16666666,'lng' => -59.53333333 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BARBADOS']);
        DB::table('pais')->insert(['nombre' => 'Bélgica', 'siglas' => 'BEL', 'iso' => 'BE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 50.83333333,'lng' => 4 ,'federacion' => 'FEDERACIÓN BELGA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Belice', 'siglas' => 'BLZ', 'iso' => 'BZ', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 17.25,'lng' => -88.75 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BELICE']);
        DB::table('pais')->insert(['nombre' => 'Benín', 'siglas' => 'BEN', 'iso' => 'BJ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 9.5,'lng' => 2.25 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BENÍN']);
        DB::table('pais')->insert(['nombre' => 'Bermudas', 'siglas' => 'BER', 'iso' => 'BM', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 32.33333333,'lng' => -64.75 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BERMUDAS']);
        DB::table('pais')->insert(['nombre' => 'Bielorrusia', 'siglas' => 'BLR', 'iso' => 'BY', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 53,'lng' => 28 ,'federacion' => 'FEDERACIÓN BIELORRUSA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Bolivia', 'siglas' => 'BOL', 'iso' => 'BO', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -17,'lng' => -65 ,'federacion' => 'FEDERACIÓN BOLIVIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Bosnia y Herzegovina', 'siglas' => 'BIH', 'iso' => 'BA', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 44,'lng' => 18 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BOSNIA Y HERZEGOVINA']);
        DB::table('pais')->insert(['nombre' => 'Botsuana', 'siglas' => 'BOT', 'iso' => 'BW', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -22,'lng' => 24 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BOTSUANA']);
        DB::table('pais')->insert(['nombre' => 'Brasil', 'siglas' => 'BRA', 'iso' => 'BR', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -10,'lng' => -55 ,'federacion' => 'CONFEDERACIÓN BRASILEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Brunéi Darussalam', 'siglas' => 'BRU', 'iso' => 'BN', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 4.5,'lng' => 114.66666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BRUNÉI DARUSALAM']);
        DB::table('pais')->insert(['nombre' => 'Bulgaria', 'siglas' => 'BUL', 'iso' => 'BG', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 43,'lng' => 25 ,'federacion' => 'FEDERACIÓN BÚLGARA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Burkina Faso', 'siglas' => 'BFA', 'iso' => 'BF', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 13,'lng' => -2 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BURKINA FASO']);
        DB::table('pais')->insert(['nombre' => 'Burundi', 'siglas' => 'BDI', 'iso' => 'BI', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -3.5,'lng' => 30 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BURUNDI']);
        DB::table('pais')->insert(['nombre' => 'Bután', 'siglas' => 'BHU', 'iso' => 'BT', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 27.5,'lng' => 90.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE BUTÁN']);
        DB::table('pais')->insert(['nombre' => 'Cabo Verde', 'siglas' => 'CPV', 'iso' => 'CV', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 16,'lng' => -24 ,'federacion' => 'FEDERACIÓN CABOVERDIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Camboya', 'siglas' => 'CAM', 'iso' => 'KH', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 13,'lng' => 105 ,'federacion' => 'FEDERACIÓN CAMBOYANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Camerún', 'siglas' => 'CMR', 'iso' => 'CM', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 6,'lng' => 12 ,'federacion' => 'FEDERACIÓN CAMERUNESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Canadá', 'siglas' => 'CAN', 'iso' => 'CA', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 60,'lng' => -95 ,'federacion' => 'FEDERACIÓN CANADIENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Chad', 'siglas' => 'CHA', 'iso' => 'TD', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => 19 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DEL CHAD']);
        DB::table('pais')->insert(['nombre' => 'Chile', 'siglas' => 'CHI', 'iso' => 'CL', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -30,'lng' => -71 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE CHILE']);
        DB::table('pais')->insert(['nombre' => 'China', 'siglas' => 'CHN', 'iso' => 'CN', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 35,'lng' => 105 ,'federacion' => 'FEDERACIÓN CHINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Chipre', 'siglas' => 'CYP', 'iso' => 'CY', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 35,'lng' => 33 ,'federacion' => 'FEDERACIÓN CHIPRIOTA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Colombia', 'siglas' => 'COL', 'iso' => 'CO', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => 4,'lng' => -72 ,'federacion' => 'FEDERACIÓN COLOMBIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Comoras', 'siglas' => 'COM', 'iso' => 'KM', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -12.16666666,'lng' => 44.25 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE COMORAS']);
        DB::table('pais')->insert(['nombre' => 'Congo', 'siglas' => 'CGO', 'iso' => 'CG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -1,'lng' => 15 ,'federacion' => 'FEDERACIÓN CONGOLEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Corea del Norte', 'siglas' => 'PRK', 'iso' => 'KP', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 40,'lng' => 127 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA RPD DE COREA']);
        DB::table('pais')->insert(['nombre' => 'Corea del Sur', 'siglas' => 'KOR', 'iso' => 'KR', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 37,'lng' => 127.5 ,'federacion' => 'FEDERACIÓN COREANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Costa de Marfil', 'siglas' => 'CIV', 'iso' => 'CI', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 8,'lng' => -5 ,'federacion' => 'FEDERACIÓN MARFILEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Costa Rica', 'siglas' => 'CRC', 'iso' => 'CR', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 10,'lng' => -84 ,'federacion' => 'FEDERACIÓN COSTARRICENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Croacia', 'siglas' => 'CRO', 'iso' => 'HR', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 45.16666666,'lng' => 15.5 ,'federacion' => 'FEDERACIÓN CROATA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Cuba', 'siglas' => 'CUB', 'iso' => 'CU', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 21.5,'lng' => -80 ,'federacion' => 'ASOCIACIÓN DE FÚTBOL DE CUBA']);
        DB::table('pais')->insert(['nombre' => 'Curazao', 'siglas' => 'CUW', 'iso' => 'CW', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 12.16957,'lng' => -68.990021 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE CURASAO']);
        DB::table('pais')->insert(['nombre' => 'Dinamarca', 'siglas' => 'DEN', 'iso' => 'DK', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 56,'lng' => 10 ,'federacion' => 'FEDERACIÓN DANESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Dominica', 'siglas' => 'DMA', 'iso' => 'DM', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 15.41666666,'lng' => -61.33333333 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE DOMINICA']);
        DB::table('pais')->insert(['nombre' => 'Ecuador', 'siglas' => 'ECU', 'iso' => 'EC', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -2,'lng' => -77.5 ,'federacion' => 'FEDERACIÓN ECUATORIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'EE UU', 'siglas' => 'USA', 'iso' => 'US', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 38,'lng' => -97 ,'federacion' => 'FEDERACIÓN ESTADOUNIDENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Egipto', 'siglas' => 'EGY', 'iso' => 'EG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 27,'lng' => 30 ,'federacion' => 'FEDERACIÓN EGIPCIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'El Salvador', 'siglas' => 'SLV', 'iso' => 'SV', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 13.83333333,'lng' => -88.91666666 ,'federacion' => 'FEDERACIÓN SALVADOREÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Emiratos Árabes Unidos', 'siglas' => 'UAE', 'iso' => 'AE', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 24,'lng' => 54 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE EMIRATOS ÁRABES UNIDOS']);
        DB::table('pais')->insert(['nombre' => 'Eritrea', 'siglas' => 'ERI', 'iso' => 'ER', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => 39 ,'federacion' => 'FEDERACIÓN ERITREA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Escocia', 'siglas' => 'SCO', 'iso' => 'GB', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 54,'lng' => -2 ,'federacion' => 'FEDERACIÓN ESCOCESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Eslovaquia', 'siglas' => 'SVK', 'iso' => 'SK', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 48.6737532,'lng' => 19.696058 ,'federacion' => 'FEDERACIÓN ESLOVACA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Eslovenia', 'siglas' => 'SVN', 'iso' => 'SI', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 46.11666666,'lng' => 14.81666666 ,'federacion' => 'FEDERACIÓN ESLOVENA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'España', 'siglas' => 'ESP', 'iso' => 'ES', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 40,'lng' => -4 ,'federacion' => 'REAL FEDERACIÓN ESPAÑOLA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Estonia', 'siglas' => 'EST', 'iso' => 'EE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 59,'lng' => 26 ,'federacion' => 'FEDERACIÓN ESTONIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Etiopía', 'siglas' => 'ETH', 'iso' => 'ET', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 8,'lng' => 38 ,'federacion' => 'FEDERACIÓN ETÍOPE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Filipinas', 'siglas' => 'PHI', 'iso' => 'PH', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 13,'lng' => 122 ,'federacion' => 'FEDERACIÓN FILIPINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Finlandia', 'siglas' => 'FIN', 'iso' => 'FI', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 64,'lng' => 26 ,'federacion' => 'FEDERACIÓN FINLANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Fiyi', 'siglas' => 'FIJ', 'iso' => 'FJ', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -18,'lng' => 175 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE FIYI']);
        DB::table('pais')->insert(['nombre' => 'Francia', 'siglas' => 'FRA', 'iso' => 'FR', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 46,'lng' => 2 ,'federacion' => 'FEDERACIÓN FRANCESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Gabón', 'siglas' => 'GAB', 'iso' => 'GA', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -1,'lng' => 11.75 ,'federacion' => 'FEDERACIÓN GABONESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Gales', 'siglas' => 'WAL', 'iso' => 'GB', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 54,'lng' => -2 ,'federacion' => 'FEDERACIÓN GALESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Gambia', 'siglas' => 'GAM', 'iso' => 'GM', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 13.46666666,'lng' => -16.56666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GAMBIA']);
        DB::table('pais')->insert(['nombre' => 'Georgia', 'siglas' => 'GEO', 'iso' => 'GE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 42,'lng' => 43.5 ,'federacion' => 'FEDERACIÓN GEORGIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Ghana', 'siglas' => 'GHA', 'iso' => 'GH', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 8,'lng' => -2 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GHANA']);
        DB::table('pais')->insert(['nombre' => 'Gibraltar', 'siglas' => 'GIB', 'iso' => 'GI', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 36.13333333,'lng' => -5.35 ,'federacion' => 'FEDERACIÓN GIBRALTAREÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Granada', 'siglas' => 'GRN', 'iso' => 'GD', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 12.11666666,'lng' => -61.66666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GRANADA']);
        DB::table('pais')->insert(['nombre' => 'Grecia', 'siglas' => 'GRE', 'iso' => 'GR', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 39,'lng' => 22 ,'federacion' => 'FEDERACIÓN GRIEGA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Guam', 'siglas' => 'GUM', 'iso' => 'GU', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 13.46666666,'lng' => 144.78333333 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GUAM']);
        DB::table('pais')->insert(['nombre' => 'Guatemala', 'siglas' => 'GUA', 'iso' => 'GT', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 15.5,'lng' => -90.25 ,'federacion' => 'FEDERACIÓN NACIONAL DE FÚTBOL DE GUATEMALA']);
        DB::table('pais')->insert(['nombre' => 'Guinea', 'siglas' => 'GUI', 'iso' => 'GN', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 11,'lng' => -10 ,'federacion' => 'FEDERACIÓN GUINEANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Guinea Ecuatorial', 'siglas' => 'EQG', 'iso' => 'GQ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 2,'lng' => 10 ,'federacion' => 'FEDERACIÓN ECUATOGUINEANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Guinea-Bissáu', 'siglas' => 'GNB', 'iso' => 'GW', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 12,'lng' => -15 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GUINEA-BISÁU']);
        DB::table('pais')->insert(['nombre' => 'Guyana', 'siglas' => 'GUY', 'iso' => 'GY', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 5,'lng' => -59 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE GUYANA']);
        DB::table('pais')->insert(['nombre' => 'Haití', 'siglas' => 'HAI', 'iso' => 'HT', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 19,'lng' => -72.41666666 ,'federacion' => 'FEDERACIÓN HAITIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Honduras', 'siglas' => 'HON', 'iso' => 'HN', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => -86.5 ,'federacion' => 'FEDERACIÓN NACIONAL AUTÓNOMA DE FÚTBOL DE HONDURAS']);
        DB::table('pais')->insert(['nombre' => 'Hong Kong', 'siglas' => 'HKG', 'iso' => 'HK', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 22.25,'lng' => 114.16666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE HONG KONG']);
        DB::table('pais')->insert(['nombre' => 'Hungría', 'siglas' => 'HUN', 'iso' => 'HU', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 47,'lng' => 20 ,'federacion' => 'FEDERACIÓN HÚNGARA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'India', 'siglas' => 'IND', 'iso' => 'IN', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 20,'lng' => 77 ,'federacion' => 'FEDERACIÓN INDIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Indonesia', 'siglas' => 'IDN', 'iso' => 'ID', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => -5,'lng' => 120 ,'federacion' => 'FEDERACIÓN INDONESIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Inglaterra', 'siglas' => 'ENG', 'iso' => 'GB', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 54,'lng' => -2 ,'federacion' => 'FEDERACIÓN INGLESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Irak', 'siglas' => 'IRQ', 'iso' => 'IQ', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 33,'lng' => 44 ,'federacion' => 'FEDERACIÓN IRAQUÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Irán', 'siglas' => 'IRN', 'iso' => 'IR', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 32,'lng' => 53 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA RI DE IRÁN']);
        DB::table('pais')->insert(['nombre' => 'Irlanda', 'siglas' => 'IRL', 'iso' => 'IE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 53,'lng' => -8 ,'federacion' => 'FEDERACIÓN IRLANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Irlanda del Norte', 'siglas' => 'NIR', 'iso' => 'GB', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 54,'lng' => -2 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE IRLANDA DEL NORTE']);
        DB::table('pais')->insert(['nombre' => 'Islandia', 'siglas' => 'ISL', 'iso' => 'IS', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 65,'lng' => -18 ,'federacion' => 'FEDERACIÓN ISLANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Islas Caimán', 'siglas' => 'CAY', 'iso' => 'KY', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 19.5,'lng' => -80.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS CAIMÁN']);
        DB::table('pais')->insert(['nombre' => 'Islas Cook', 'siglas' => 'COK', 'iso' => 'CK', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -21.23333333,'lng' => -159.76666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS COOK']);
        DB::table('pais')->insert(['nombre' => 'Islas Feroe', 'siglas' => 'FRO', 'iso' => 'FO', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 62,'lng' => -7 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS FEROE']);
        DB::table('pais')->insert(['nombre' => 'Islas Salomón', 'siglas' => 'SOL', 'iso' => 'SB', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -8,'lng' => 159 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS SALOMÓN']);
        DB::table('pais')->insert(['nombre' => 'Islas Vírgenes Británicas', 'siglas' => 'VGB', 'iso' => 'VG', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 18.431383,'lng' => -64.62305 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS VÍRGENES BRITÁNICAS']);
        DB::table('pais')->insert(['nombre' => 'Islas Vírgenes', 'siglas' => 'VIR', 'iso' => 'VI', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 18.34,'lng' => -64.93 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS ISLAS VÍRGENES AMERICANAS']);
        DB::table('pais')->insert(['nombre' => 'Israel', 'siglas' => 'ISR', 'iso' => 'IL', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 31.5,'lng' => 34.75 ,'federacion' => 'FEDERACIÓN ISRAELÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Italia', 'siglas' => 'ITA', 'iso' => 'IT', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 42.83333333,'lng' => 12.83333333 ,'federacion' => 'FEDERACIÓN ITALIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Jamaica', 'siglas' => 'JAM', 'iso' => 'JM', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 18.25,'lng' => -77.5 ,'federacion' => 'FEDERACIÓN JAMAICANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Japón', 'siglas' => 'JPN', 'iso' => 'JP', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 36,'lng' => 138 ,'federacion' => 'FEDERACIÓN JAPONESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Jordania', 'siglas' => 'JOR', 'iso' => 'JO', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 31,'lng' => 36 ,'federacion' => 'FEDERACIÓN JORDANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Kazajstán', 'siglas' => 'KAZ', 'iso' => 'KZ', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 48,'lng' => 68 ,'federacion' => 'FEDERACIÓN KAZAJA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Kenia', 'siglas' => 'KEN', 'iso' => 'KE', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 1,'lng' => 38 ,'federacion' => 'FEDERACIÓN KENIATA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Kirguistán', 'siglas' => 'KGZ', 'iso' => 'KG', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 41,'lng' => 75 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA REPÚBLICA KIRGUISA']);
        DB::table('pais')->insert(['nombre' => 'Kosovo', 'siglas' => 'KVX', 'iso' => 'XK', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 42.666667,'lng' => 21.166667 ,'federacion' => 'FEDERACIÓN KOSOVAR DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Kuwait', 'siglas' => 'KUW', 'iso' => 'KW', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 29.5,'lng' => 45.75 ,'federacion' => 'FEDERACIÓN KUWAITÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Laos', 'siglas' => 'LAO', 'iso' => 'LA', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 18,'lng' => 105 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAOS']);
        DB::table('pais')->insert(['nombre' => 'Lesoto', 'siglas' => 'LES', 'iso' => 'LS', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -29.5,'lng' => 28.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LESOTO']);
        DB::table('pais')->insert(['nombre' => 'Letonia', 'siglas' => 'LVA', 'iso' => 'LV', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 57,'lng' => 25 ,'federacion' => 'FEDERACIÓN LETONA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Líbano', 'siglas' => 'LIB', 'iso' => 'LB', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 33.83333333,'lng' => 35.83333333 ,'federacion' => 'FEDERACIÓN LIBANESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Liberia', 'siglas' => 'LBR', 'iso' => 'LR', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 6.5,'lng' => -9.5 ,'federacion' => 'FEDERACIÓN LIBERIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Libia', 'siglas' => 'LBY', 'iso' => 'LY', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 25,'lng' => 17 ,'federacion' => 'FEDERACIÓN LIBIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Liechtenstein', 'siglas' => 'LIE', 'iso' => 'LI', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 47.26666666,'lng' => 9.53333333 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LIECHTENSTEIN']);
        DB::table('pais')->insert(['nombre' => 'Lituania', 'siglas' => 'LTU', 'iso' => 'LT', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 56,'lng' => 24 ,'federacion' => 'FEDERACIÓN LITUANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Luxemburgo', 'siglas' => 'LUX', 'iso' => 'LU', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 49.75,'lng' => 6.16666666 ,'federacion' => 'FEDERACIÓN LUXEMBURGUESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Macao', 'siglas' => 'MAC', 'iso' => 'MO', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 22.16666666,'lng' => 113.55 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MACAO']);
        DB::table('pais')->insert(['nombre' => 'Macedonia', 'siglas' => 'MKD', 'iso' => 'MK', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 41.83333333,'lng' => 22 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MACEDONIA DEL NORTE']);
        DB::table('pais')->insert(['nombre' => 'Madagascar', 'siglas' => 'MAD', 'iso' => 'MG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -20,'lng' => 47 ,'federacion' => 'FEDERACIÓN MALGACHE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Malasia', 'siglas' => 'MAS', 'iso' => 'MY', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 2.5,'lng' => 112.5 ,'federacion' => 'FEDERACIÓN MALASIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Malaui', 'siglas' => 'MWI', 'iso' => 'MW', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -13.5,'lng' => 34 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MALAUI']);
        DB::table('pais')->insert(['nombre' => 'Maldivas', 'siglas' => 'MDV', 'iso' => 'MV', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 3.25,'lng' => 73 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS MALDIVAS']);
        DB::table('pais')->insert(['nombre' => 'Mali', 'siglas' => 'MLI', 'iso' => 'ML', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 17,'lng' => -4 ,'federacion' => 'FEDERACIÓN MALIENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Malta', 'siglas' => 'MLT', 'iso' => 'MT', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 35.83333333,'lng' => 14.58333333 ,'federacion' => 'FEDERACIÓN MALTESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Marruecos', 'siglas' => 'MAR', 'iso' => 'MA', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 32,'lng' => -5 ,'federacion' => 'FEDERACIÓN MARROQUÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Mauricio', 'siglas' => 'MRI', 'iso' => 'MU', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -20.28333333,'lng' => 57.55 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MAURICIO']);
        DB::table('pais')->insert(['nombre' => 'Mauritania', 'siglas' => 'MTN', 'iso' => 'MR', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 20,'lng' => -12 ,'federacion' => 'FEDERACIÓN MAURITANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'México', 'siglas' => 'MEX', 'iso' => 'MX', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 23,'lng' => -102 ,'federacion' => 'FEDERACIÓN MEXICANA DE FÚTBOL ASOCIACIÓN']);
        DB::table('pais')->insert(['nombre' => 'Moldavia', 'siglas' => 'MDA', 'iso' => 'MD', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 47,'lng' => 29 ,'federacion' => 'FEDERACIÓN MOLDAVA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Mongolia', 'siglas' => 'MNG', 'iso' => 'MN', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 46,'lng' => 105 ,'federacion' => 'FEDERACIÓN MONGOLA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Montenegro', 'siglas' => 'MNE', 'iso' => 'ME', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 42.5,'lng' => 19.3 ,'federacion' => 'FEDERACIÓN MONTENEGRINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Montserrat', 'siglas' => 'MSR', 'iso' => 'MS', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 16.75,'lng' => -62.2 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MONTSERRAT']);
        DB::table('pais')->insert(['nombre' => 'Mozambique', 'siglas' => 'MOZ', 'iso' => 'MZ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -18.25,'lng' => 35 ,'federacion' => 'FEDERACIÓN MOZAMBIQUEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Myanmar', 'siglas' => 'MYA', 'iso' => 'MM', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 22,'lng' => 98 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE MYANMAR']);
        DB::table('pais')->insert(['nombre' => 'Namibia', 'siglas' => 'NAM', 'iso' => 'NA', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -22,'lng' => 17 ,'federacion' => 'FEDERACIÓN NAMIBIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Nepal', 'siglas' => 'NEP', 'iso' => 'NP', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 28,'lng' => 84 ,'federacion' => 'FEDERACIÓN NEPALÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Nicaragua', 'siglas' => 'NCA', 'iso' => 'NI', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 13,'lng' => -85 ,'federacion' => 'FEDERACIÓN NICARAGÜENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Níger', 'siglas' => 'NIG', 'iso' => 'NE', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 16,'lng' => 8 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE NÍGER']);
        DB::table('pais')->insert(['nombre' => 'Nigeria', 'siglas' => 'NGA', 'iso' => 'NG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 10,'lng' => 8 ,'federacion' => 'FEDERACIÓN NIGERIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Noruega', 'siglas' => 'NOR', 'iso' => 'NO', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 62,'lng' => 10 ,'federacion' => 'FEDERACIÓN NORUEGA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Nueva Caledonia', 'siglas' => 'NCL', 'iso' => 'NC', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -21.5,'lng' => 165.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE NUEVA CALEDONIA']);
        DB::table('pais')->insert(['nombre' => 'Nueva Zelanda', 'siglas' => 'NZL', 'iso' => 'NZ', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -41,'lng' => 174 ,'federacion' => 'FEDERACIÓN NEOZELANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Omán', 'siglas' => 'OMA', 'iso' => 'OM', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 21,'lng' => 57 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE OMÁN']);
        DB::table('pais')->insert(['nombre' => 'Holanda', 'siglas' => 'NED', 'iso' => 'NL', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 52.5,'lng' => 5.75 ,'federacion' => 'FEDERACIÓN NEERLANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Pakistán', 'siglas' => 'PAK', 'iso' => 'PK', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 30,'lng' => 70 ,'federacion' => 'FEDERACIÓN PAKISTANÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Palestina', 'siglas' => 'PLE', 'iso' => 'PS', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 31.9,'lng' => 35.2 ,'federacion' => 'FEDERACIÓN PALESTINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Panamá', 'siglas' => 'PAN', 'iso' => 'PA', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 9,'lng' => -80 ,'federacion' => 'FEDERACIÓN PANAMEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Papúa Nueva Guinea', 'siglas' => 'PNG', 'iso' => 'PG', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -6,'lng' => 147 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE PAPÚA NUEVA GUINEA']);
        DB::table('pais')->insert(['nombre' => 'Paraguay', 'siglas' => 'PAR', 'iso' => 'PY', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -23,'lng' => -58 ,'federacion' => 'ASOCIACIÓN PARAGUAYA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Perú', 'siglas' => 'PER', 'iso' => 'PE', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -10,'lng' => -76 ,'federacion' => 'FEDERACIÓN PERUANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Polonia', 'siglas' => 'POL', 'iso' => 'PL', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 52,'lng' => 20 ,'federacion' => 'FEDERACIÓN POLACA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Portugal', 'siglas' => 'POR', 'iso' => 'PT', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 39.5,'lng' => -8 ,'federacion' => 'FEDERACIÓN PORTUGUESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Puerto Rico', 'siglas' => 'PUR', 'iso' => 'PR', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 18.25,'lng' => -66.5 ,'federacion' => 'FEDERACIÓN PUERTORRIQUEÑA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Qatar', 'siglas' => 'QAT', 'iso' => 'QA', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 25.5,'lng' => 51.25 ,'federacion' => 'FEDERACIÓN CATARÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'RD del Congo', 'siglas' => 'COD', 'iso' => 'CD', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 0,'lng' => 25 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA RD DEL CONGO']);
        DB::table('pais')->insert(['nombre' => 'República Centroafricana', 'siglas' => 'CTA', 'iso' => 'CF', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 7,'lng' => 21 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA REPÚBLICA CENTROAFRICANA']);
        DB::table('pais')->insert(['nombre' => 'República Checa', 'siglas' => 'CZE', 'iso' => 'CZ', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 49.75,'lng' => 15.5 ,'federacion' => 'FEDERACIÓN CHECA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'República Dominicana', 'siglas' => 'DOM', 'iso' => 'DO', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 19,'lng' => -70.66666666 ,'federacion' => 'FEDERACIÓN DOMINICANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Ruanda', 'siglas' => 'RWA', 'iso' => 'RW', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -2,'lng' => 30 ,'federacion' => 'FEDERACIÓN RUANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Rumanía', 'siglas' => 'ROU', 'iso' => 'RO', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 46,'lng' => 25 ,'federacion' => 'FEDERACIÓN RUMANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Rusia', 'siglas' => 'RUS', 'iso' => 'RU', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 60,'lng' => 100 ,'federacion' => 'FEDERACIÓN RUSA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Samoa', 'siglas' => 'SAM', 'iso' => 'WS', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -13.58333333,'lng' => -172.33333333 ,'federacion' => 'FEDERACIÓN SAMOANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Samoa Americana', 'siglas' => 'ASA', 'iso' => 'AS', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -14.33333333,'lng' => -170 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LA SAMOA ESTADOUNIDENSE']);
        DB::table('pais')->insert(['nombre' => 'San Cristóbal y Nieves', 'siglas' => 'SKN', 'iso' => 'KN', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 17.33333333,'lng' => -62.75 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SAN CRISTÓBAL Y NIEVES']);
        DB::table('pais')->insert(['nombre' => 'San Marino', 'siglas' => 'SMR', 'iso' => 'SM', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 43.76666666,'lng' => 12.41666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SAN MARINO']);
        DB::table('pais')->insert(['nombre' => 'San Vicente y las Granadinas', 'siglas' => 'VIN', 'iso' => 'VC', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 13.25,'lng' => -61.2 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SAN VICENTE Y LAS GRANADINAS']);
        DB::table('pais')->insert(['nombre' => 'Santa Lucía', 'siglas' => 'LCA', 'iso' => 'LC', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 13.88333333,'lng' => -60.96666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SANTA LUCÍA']);
        DB::table('pais')->insert(['nombre' => 'Santo Tomé y Príncipe', 'siglas' => 'STP', 'iso' => 'ST', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 1,'lng' => 7 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SANTO TOMÉ Y PRÍNCIPE']);
        DB::table('pais')->insert(['nombre' => 'Senegal', 'siglas' => 'SEN', 'iso' => 'SN', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 14,'lng' => -14 ,'federacion' => 'FEDERACIÓN SENEGALESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Serbia', 'siglas' => 'SRB', 'iso' => 'RS', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 44,'lng' => 21 ,'federacion' => 'FEDERACIÓN SERBIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Seychelles', 'siglas' => 'SEY', 'iso' => 'SC', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -4.58333333,'lng' => 55.66666666 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE LAS SEYCHELLES']);
        DB::table('pais')->insert(['nombre' => 'Sierra Leona', 'siglas' => 'SLE', 'iso' => 'SL', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 8.5,'lng' => -11.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SIERRA LEONA']);
        DB::table('pais')->insert(['nombre' => 'Singapur', 'siglas' => 'SIN', 'iso' => 'SG', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 1.36666666,'lng' => 103.8 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SINGAPUR']);
        DB::table('pais')->insert(['nombre' => 'Siria', 'siglas' => 'SYR', 'iso' => 'SY', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 35,'lng' => 38 ,'federacion' => 'FEDERACIÓN SIRIA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Somalia', 'siglas' => 'SOM', 'iso' => 'SO', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 10,'lng' => 49 ,'federacion' => 'FEDERACIÓN SOMALÍ DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Sri Lanka', 'siglas' => 'SRI', 'iso' => 'LK', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 7,'lng' => 81 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SRI LANKA']);
        DB::table('pais')->insert(['nombre' => 'Suazilandia', 'siglas' => 'SWZ', 'iso' => 'SZ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -26.5,'lng' => 31.5 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SUAZILANDIA']);
        DB::table('pais')->insert(['nombre' => 'Sudáfrica', 'siglas' => 'RSA', 'iso' => 'ZA', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -29,'lng' => 24 ,'federacion' => 'FEDERACIÓN SUDAFRICANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Sudán', 'siglas' => 'SDN', 'iso' => 'SD', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => 30 ,'federacion' => 'FEDERACIÓN SUDANESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Sudán del Sur', 'siglas' => 'SSD', 'iso' => 'SS', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 7,'lng' => 30 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SUDÁN DEL SUR']);
        DB::table('pais')->insert(['nombre' => 'Suecia', 'siglas' => 'SWE', 'iso' => 'SE', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 62,'lng' => 15 ,'federacion' => 'FEDERACIÓN SUECA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Suiza', 'siglas' => 'SUI', 'iso' => 'CH', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 47,'lng' => 8 ,'federacion' => 'FEDERACIÓN SUIZA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Surinam', 'siglas' => 'SUR', 'iso' => 'SR', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 4,'lng' => -56 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE SURINAM']);
        DB::table('pais')->insert(['nombre' => 'Tahití', 'siglas' => 'TAH', 'iso' => 'PF', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -17.6333308,'lng' => -149.4499982 ,'federacion' => 'FEDERACIÓN TAHITIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Tailandia', 'siglas' => 'THA', 'iso' => 'TH', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => 100 ,'federacion' => 'FEDERACIÓN TAILANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Taipei', 'siglas' => 'TPE', 'iso' => 'TW', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 25.033964,'lng' => 121.564468 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TAIPÉI']);
        DB::table('pais')->insert(['nombre' => 'Tanzania', 'siglas' => 'TAN', 'iso' => 'TZ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -6,'lng' => 35 ,'federacion' => 'FEDERACIÓN TANZANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Tayikistán', 'siglas' => 'TJK', 'iso' => 'TJ', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 39,'lng' => 71 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TAYIKISTÁN']);
        DB::table('pais')->insert(['nombre' => 'Timor Oriental', 'siglas' => 'TLS', 'iso' => 'TL', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => -8.83333333,'lng' => 125.91666666 ,'federacion' => 'FEDERACIÓN TIMORENSE DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Togo', 'siglas' => 'TOG', 'iso' => 'TG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 8,'lng' => 1.16666666 ,'federacion' => 'FEDERACIÓN TOGOLESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Tonga', 'siglas' => 'TGA', 'iso' => 'TO', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -20,'lng' => -175 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TONGA']);
        DB::table('pais')->insert(['nombre' => 'Trinidad y Tobago', 'siglas' => 'TRI', 'iso' => 'TT', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 11,'lng' => -61 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TRINIDAD Y TOBAGO']);
        DB::table('pais')->insert(['nombre' => 'Túnez', 'siglas' => 'TUN', 'iso' => 'TN', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 34,'lng' => 9 ,'federacion' => 'FEDERACIÓN TUNECINA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Turcas y Caicos', 'siglas' => 'TCA', 'iso' => 'TC', 'confederacion_id' => 3, 'puntos' => 0, 'user_id' => 1,'lat' => 21.75,'lng' => -71.58333333 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TURCAS Y CAICOS']);
        DB::table('pais')->insert(['nombre' => 'Turkmenistán', 'siglas' => 'TKM', 'iso' => 'TM', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 40,'lng' => 60 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE TURKMENISTÁN']);
        DB::table('pais')->insert(['nombre' => 'Turquía', 'siglas' => 'TUR', 'iso' => 'TR', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 39,'lng' => 35 ,'federacion' => 'FEDERACIÓN TURCA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Ucrania', 'siglas' => 'UKR', 'iso' => 'UA', 'confederacion_id' => 1, 'puntos' => 0, 'user_id' => 1,'lat' => 49,'lng' => 32 ,'federacion' => 'ASOCIACIÓN UCRANIANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Uganda', 'siglas' => 'UGA', 'iso' => 'UG', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 1,'lng' => 32 ,'federacion' => 'FEDERACIÓN UGANDESA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Uruguay', 'siglas' => 'URU', 'iso' => 'UY', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => -33,'lng' => -56 ,'federacion' => 'FEDERACIÓN URUGUAYA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Uzbekistán', 'siglas' => 'UZB', 'iso' => 'UZ', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 41,'lng' => 64 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE UZBEKISTÁN']);
        DB::table('pais')->insert(['nombre' => 'Vanuatu', 'siglas' => 'VAN', 'iso' => 'VU', 'confederacion_id' => 5, 'puntos' => 0, 'user_id' => 1,'lat' => -16,'lng' => 167 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE VANUATU']);
        DB::table('pais')->insert(['nombre' => 'Venezuela', 'siglas' => 'VEN', 'iso' => 'VE', 'confederacion_id' => 2, 'puntos' => 0, 'user_id' => 1,'lat' => 8,'lng' => -66 ,'federacion' => 'FEDERACIÓN VENEZOLANA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Vietnam', 'siglas' => 'VIE', 'iso' => 'VN', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 16.16666666,'lng' => 107.83333333 ,'federacion' => 'FEDERACIÓN VIETNAMITA DE FÚTBOL']);
        DB::table('pais')->insert(['nombre' => 'Yemen', 'siglas' => 'YEM', 'iso' => 'YE', 'confederacion_id' => 6, 'puntos' => 0, 'user_id' => 1,'lat' => 15,'lng' => 48 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DEL YEMEN']);
        DB::table('pais')->insert(['nombre' => 'Yibuti', 'siglas' => 'DJI', 'iso' => 'DJ', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => 11.5,'lng' => 43 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE YIBUTI']);
        DB::table('pais')->insert(['nombre' => 'Zambia', 'siglas' => 'ZAM', 'iso' => 'ZM', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -15,'lng' => 30 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ZAMBIA']);
        DB::table('pais')->insert(['nombre' => 'Zimbabue', 'siglas' => 'ZIM', 'iso' => 'ZW', 'confederacion_id' => 4, 'puntos' => 0, 'user_id' => 1,'lat' => -20,'lng' => 30 ,'federacion' => 'FEDERACIÓN DE FÚTBOL DE ZIMBABUE']);

    }
}







































































































































































































































































































































































































































