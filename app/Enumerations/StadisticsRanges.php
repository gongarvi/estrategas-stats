<?php

namespace App\Enumerations;

/**
 * @method static self range()
 * @method static self name()
 */
enum StadisticsRanges{
    case Development;
    case AverageDevelopmentCost;
    case AverageDevelopment;
    case DevelopmentClicks;
    case MonarchPointsSpent;
    case AveragteGobermentPoints;
    case Innovation;
    case Provinces;
    case Income;
    case OverallSpent;
    case AdvisorsSpent;
    case TotalValue;
    case ArmyQuality;
    case ArmyLimit;
    case Manpower;
    case ManpowerRecovery;
    case Professionalism;
    case ArmyStrength;
    case CountryForce;
    case NavalStrength;
    case TOPs;

    //case GreatPower;
    //case Absolutism;

    public function range(){
        return match($this){
            StadisticsRanges::Development => "Seguimiento!B9:J{RANGE}",
            //StadisticsRanges::GreatPower => "Seguimiento!M9:U{RANGE}",
            StadisticsRanges::Income => "Seguimiento!X9:AF{RANGE}",
            StadisticsRanges::Professionalism => "Seguimiento!AI9:AQ{RANGE}",
            StadisticsRanges::ArmyLimit => "Seguimiento!AT9:BB{RANGE}",
            StadisticsRanges::Innovation => "Seguimiento!BE9:BM{RANGE}",
            StadisticsRanges::Manpower => "Seguimiento!BP9:BX{RANGE}",
            StadisticsRanges::AverageDevelopment => "Seguimiento!CA9:CI{RANGE}",
            StadisticsRanges::OverallSpent => "Seguimiento!CL9:CT{RANGE}",
            StadisticsRanges::ManpowerRecovery => "Seguimiento!CW9:DE{RANGE}",
            StadisticsRanges::Provinces => "Seguimiento!DH9:DP{RANGE}",
            //StadisticsRanges::Absolutism => "Seguimiento!DS9:EA{RANGE}",
            StadisticsRanges::ArmyStrength => "Seguimiento!ED9:EL{RANGE}",
            StadisticsRanges::TotalValue => "Seguimiento!EO9:EW{RANGE}",
            StadisticsRanges::NavalStrength => "Seguimiento!EZ9:FH{RANGE}",
            StadisticsRanges::MonarchPointsSpent => "Seguimiento!FK9:FS{RANGE}",
            StadisticsRanges::ArmyQuality => "Seguimiento!FV9:GD{RANGE}",
            StadisticsRanges::AdvisorsSpent => "Seguimiento!GG9:GO{RANGE}",
            StadisticsRanges::AverageDevelopmentCost => "Seguimiento!GR9:GZ{RANGE}",
            StadisticsRanges::DevelopmentClicks => "Seguimiento!HC9:HK{RANGE}",
            StadisticsRanges::AveragteGobermentPoints => "Seguimiento!HN9:HV{RANGE}",
            StadisticsRanges::CountryForce => "Seguimiento!HY9:IG{RANGE}",
            StadisticsRanges::TOPs => "Regla de TOPs!B9:J{RANGE}"
        };
    }

    public function name(){
        return match($this){
            StadisticsRanges::Development => "Desarrollo total",
            //StadisticsRanges::GreatPower => "Puntación de Gran Potencia",
            StadisticsRanges::Income => "Ingreso mensual",
            StadisticsRanges::Professionalism => "Profesionalismo",
            StadisticsRanges::ArmyLimit => "Límite de ejército",
            StadisticsRanges::Innovation => "Innovacion",
            StadisticsRanges::Manpower => "Sodadesca máxima",
            StadisticsRanges::AverageDevelopment => "Desarrollo promedio",
            StadisticsRanges::OverallSpent => "Gasto total",
            StadisticsRanges::ManpowerRecovery => "Recuperación de soldadesca",
            StadisticsRanges::Provinces => "Número de provincias",
            //StadisticsRanges::Absolutism => "Absolutismo",
            StadisticsRanges::ArmyStrength => "Fuerza del ejército",
            StadisticsRanges::TotalValue => "Valor total de edificios",
            StadisticsRanges::NavalStrength => "Fuerza naval",
            StadisticsRanges::MonarchPointsSpent => "Puntos en desarrolloar",
            StadisticsRanges::ArmyQuality => "Calidad del ejército",
            StadisticsRanges::AdvisorsSpent => "Gasto en consejeros",
            StadisticsRanges::AverageDevelopmentCost => "Coste medio en desarrollo",
            StadisticsRanges::DevelopmentClicks => "Número de clicks en desarrollar",
            StadisticsRanges::AveragteGobermentPoints => "Media ponderada de gobernantes",
            StadisticsRanges::CountryForce => "Fuerza del país",
            StadisticsRanges::TOPs => "Países TOP y TOP+"
        };
    }
}