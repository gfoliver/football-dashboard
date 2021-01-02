<?php 

namespace App\Core\Services;

use App\Core\Entities\League;
use App\Core\Repositories\Contracts\ILeaguesRepository;
use App\Core\Services\Contracts\ILeaguesService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeaguesService implements ILeaguesService {
    private ILeaguesRepository $repository;

    public function __construct(ILeaguesRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function save(array $data): ?League
    {
        $slug = Str::slug($data['name'], '-');

        $data['slug'] = $slug;

        if (isset($data['logo'])) {
            if (isset($data['id'])) {
                $league = $this->repository->byId($data['id']);

                if (isset($league) && isset($league->logo))
                    Storage::disk('leagues')->delete($league->getRawOriginal('logo'));
            }

            $path = $data['logo']->store('/', 'leagues');

            $data['logo'] = $path;
        }

        if (isset($data['cover'])) {
            if (isset($data['id'])) {
                $league = $this->repository->byId($data['id']);

                if (isset($league) && isset($league->cover))
                    Storage::disk('leagues')->delete($league->getRawOriginal('cover'));
            }

            $path = $data['cover']->store('/', 'leagues');

            $data['cover'] = $path;
        }

        return $this->repository->save($data);
    }

    public function delete(int $id): Bool
    {
        if ($league = $this->repository->byId($id)) {

            $logo = $league->getRawOriginal('logo');
            $cover = $league->getRawOriginal('cover');

            if (isset($logo))
                Storage::disk('leagues')->delete($logo);

            if (isset($cover))
                Storage::disk('leagues')->delete($cover);

            return $this->repository->delete($id);
        }

        return false;
    }

    public function byId(int $id): ?League
    {
        return $this->repository->byId($id);
    }

    public function list(): Collection
    {
        return $this->repository->list();
    }

    public function paginate(int $per_page = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($per_page);
    }

    public function bySlug(string $slug): ?League
    {
        return $this->repository->bySlug($slug);
    }
}