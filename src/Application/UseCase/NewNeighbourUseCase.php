<?php


namespace App\Application\UseCase;


use App\Application\Ports\NeighbourRepository;
use App\Domain\Common\Email;
use App\Domain\Common\PersonalName;
use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\NeighbourId;

class NewNeighbourUseCase
{

  private NeighbourRepository $neighbourRepository;

  /**
   * NewNeighbourUseCase constructor.
   * @param NeighbourRepository $neighbourRepository
   */
  public function __construct(NeighbourRepository $neighbourRepository)
  {
    $this->neighbourRepository = $neighbourRepository;
  }

  public function execute(string $firstname, string $lastname, string $email)
  {
    $neighbourBuilder = Neighbour::builder();
    $neighbour = $neighbourBuilder->personalName(PersonalName::of($firstname, $lastname))
      ->email(Email::of($email))
      ->build();
    $this->neighbourRepository->save($neighbour);
  }
}
